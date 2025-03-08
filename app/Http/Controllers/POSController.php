<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use App\Model\API\ApiKey;
use Square\SquareClient;
use Square\SquareClientBuilder;
use Square\Payments\Requests\CreatePaymentRequest;
use Square\Types\CashPaymentDetails;
use Square\Types\Currency;
use Square\Types\Money;
use Square\Authentication\BearerAuthCredentialsBuilder;
use Square\Models\Builders\BatchRetrieveInventoryCountsRequestBuilder;
use Square\Environment;
use Square\Exceptions\ApiException;
use Carbon\Carbon;
use App\Models\Pin;
use Illuminate\Http\Request;

class POSController extends Controller
{
    public function index() {
        //return view('errors.custom')->with(['title' => 'Erreur 503 - EN MAINTENANCE', 'description' => 'Le système de caisse est présentement en maintenance. Désolé pour tout inconvéniant.','name'=> "Service Technologique J.Bédard", 'logo' => '/img/jbedard_tech_services.png', 'title', 'Error 503']);
        return view('lock')->with([
            'name' => env('NAME'),
            'image' => env('IMAGE'),
            'phone_number' => env('PHONE_NUMBER'),
            'address'=> env('ADDRESS')
        ]);
    }

    public function validateCashier($pin, $option) {
        $cashier = Pin::where('pin', '=', $pin)->first();
        if(!isset($cashier)) {
            $cashier = Pin::where('pin', '=', $pin)->where('pin', '=', 'all')->first();
        }
        if($cashier) {
            if(in_array($option, explode(';', $cashier->access)) || $cashier->access == 'all') {
                return response()->json([
                    'id' => $cashier->id,
                    'name' => isset($cashier->lastname) ? ($cashier->firstname . ' ' . $cashier->lastname[0] . '.') : $cashier->firstname,
                ]);
            } else {
                abort(403, 'access_denied');
            }
        }
        abort(403, 'pin_error');
    }

    public function registerPayment($slug, Request $request) {
        $client = SquareClientBuilder::init()
            ->bearerAuthCredentials(
                BearerAuthCredentialsBuilder::init(
                    env('SQUARE_API_KEY')
                )
            )
                ->environment(env('SQUARE_ENVIRONEMENT') == 'production' ? Environment::PRODUCTION : Environment::SANDBOX)
                ->build();
        $response = $client->payments->create(
            request: new CreatePaymentRequest(
                [
                    'idempotencyKey' => uniqid(),
                    'sourceId' => 'CASH',
                    'amountMoney' => new Money([
                        'amount' => $request->amount,
                        'currency' => Currency::Cad->value
                    ]),
                    'locationId' => 'LWWEQ6TGRQ74W'/*$user->square_location_id*/
                ],
            )
        );
    }

    public function menu($slug, $cashierID)
    {
        $cashier = PosCodes::find($cashierID);
        if($cashier) {
            $user = ApiKey::where('key', $slug)->first();
            $client = SquareClientBuilder::init()
            ->bearerAuthCredentials(
                BearerAuthCredentialsBuilder::init(
                    env('SQUARE_API_KEY')
                )
            )
                ->environment(env('SQUARE_ENVIRONEMENT') == 'production' ? Environment::PRODUCTION : Environment::SANDBOX)
                ->build();
                
                try {
                    
                    $catalogApi = $client->getCatalogApi();
                    $locationsApi = $client->getLocationsApi();
                    $invoiceApi = $client->getInvoicesApi();
                    $apiResponse = $catalogApi->listCatalog(null, 'ITEM');
                    $apiImagesResponse = $catalogApi->listCatalog(null, 'IMAGE');
                    
                    if ($apiResponse->isSuccess()) {
                        $catalog = [];
                        $catalogAPI = $apiResponse->getResult()->getObjects();
                        $invoiceApiResponse = $invoiceApi->listInvoices('LWWEQ6TGRQ74W'/*$user->square_location_id*/)->getResult()->getInvoices();
                    $catalogImages = $apiImagesResponse->getResult();
                    foreach($catalogAPI as $item) {
                        if($item->getPresentAtLocationIds()) {
                            foreach($item->getPresentAtLocationIds() as $location) {
                                if($location == 'LWWEQ6TGRQ74W'/*$user->square_location_id*/) {
                                    array_push($catalog, $item);
                                }
                            }
                        }
                    }
                    if(isset($invoiceApiResponse)) {
                        $invoices = [];
                        foreach($invoiceApiResponse as $invoice) {
                            if($invoice->getStatus() == 'UNPAID') {
                                array_push($invoices, $invoice);
                            } elseif($invoice->getStatus() == 'PARTIALLY_PAID') {
                                //dd($invoice);
                                array_push($invoices, $invoice);
                            }
                        }
                    }
                } else {
                    $errors = $apiResponse->getErrors();
                    dd($errors);
                }
            
            } catch (ApiException $e) {
                echo "ApiException occurred: <b/>";
                echo $e->getMessage() . "<p/>";
            }
            if($user) {
                return view('view.pos.menu')->with([
                    'id' => 'LWWEQ6TGRQ74W'/*$user->square_location_id*/,
                    'name' => $user->name,
                    'image' => $user->image,
                    'phone_number'=>$user->phone_number,
                    'slug' => $slug,
                    'catalog' => isset($catalog) ? $catalog : [],
                    'catalogImages' => isset($catalogImages) ? $catalogImages->getObjects() : [],
                    'invoices' => isset($invoices) ? $invoices : [],
                    'cashierName' => isset($cashier->lastname) ? ($cashier->firstname . ' ' . $cashier->lastname[0] . '.') : $cashier->firstname
                ]);
            }
        }
        return redirect('/pos/' . $slug . '/');
    }
    public function getInventoryCount($slug, $itemID) {
        $user = ApiKey::where('key', $slug)->first();
            $client = SquareClientBuilder::init()
            ->bearerAuthCredentials(
                BearerAuthCredentialsBuilder::init(
                    env('SQUARE_API_KEY')
                )
            )
                ->environment(env('SQUARE_ENVIRONEMENT') == 'production' ? Environment::PRODUCTION : Environment::SANDBOX)
                ->build();
        $inventoryApi = $client->getInventoryApi();
        $locationID = 'LWWEQ6TGRQ74W'/*$user->square_location_id*/;

    $apiResponse = $inventoryApi->retrieveInventoryCount($itemID);
    if ($apiResponse->isSuccess()) {
        $response = $apiResponse->getResult()->getCounts();
        if($response) {
            foreach ($response as $count) {
                if ($count->getLocationId() == $locationID) {
                    return response()->json($count->getQuantity());
                }
            }
        }
        return response()->json(null);
    } else {
        $errors = $apiResponse->getErrors();
    }

    // Getting more response information
    var_dump($apiResponse->getStatusCode());
    var_dump($apiResponse->getHeaders());
    }
}