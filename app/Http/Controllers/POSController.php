<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use App\Model\API\ApiKey;
use Illuminate\Support\Facades\DB;
use Square\Exceptions\ApiException;
use Carbon\Carbon;
use App\Models\Invoice;
use App\Models\Customer;
use App\Models\InvoiceItems;
use App\Models\Pin;
use App\Models\Catalog;
use App\Models\Item;
use App\Models\Transaction;
use Illuminate\Http\Request;

class POSController extends Controller
{
    public function index() {
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

    public function menu($cashierID)
    {
            $cashier = Pin::find($cashierID);   
            $category = Catalog::all();
            $invoices = Invoice::where('status','=', 'unpaid')->get();
            $customers = Customer::all();
            if($cashier) {
                return view('menu')->with([
                    'cashier_id' => $cashier->id,
                    'name' => env('NAME'),
                    'image' => env('LOGO'),
                    'phone_number'=> env('PHONE_NUMBER'),
                    'catalog' => $category->sortBy('id'),
                    'invoices' => $invoices,
                    'customers' => $customers,
                    'catalogImages' => isset($catalogImages) ? $catalogImages->getObjects() : [],
                    'invoices' => isset($invoices) ? $invoices : [],
                    'cashierName' => isset($cashier->lastname) ? ($cashier->firstname . ' ' . $cashier->lastname[0] . '.') : $cashier->firstname
                ]);
            }
        return redirect('/pos/');
    }

    public function getInvoiceItems($invoiceID) {
        return InvoiceItems::where('invoice_id', $invoiceID)->get();
    }

    public function save(Request $request) {
        
        $cashier = Pin::find($request->cashier_id);
        if($cashier) {
            $transaction = new Transaction;
            $transaction->category_id = $request->category_id;
            $transaction->item_id = ($request->item_id === 'undefined' ? null : $request->item_id);
            $transaction->price = $request->price;
            $transaction->quantity = $request->quantity;
            $transaction->cashier_id = $request->cashier_id;
            $transaction->customer_id = $request->customer_id;
            $transaction->is_promotion =  (is_null($request->is_promotion) ? false : $request->is_promotion);
            $transaction->created_at;
            $transaction->updated_at;
            $transaction->save();
            return 200;
        }
        abort(403);
    }

    public function sellInventory(Request $request) {
        $category = Catalog::where('id', $request->category_id)->first();
        try {
            $item = Item::where('id', $request->item_id)->first();
    
            if(isset($item)) {
                if($item && $item !== 'undefined' && !is_null($item)) {
                    $item->inventory -= $request->quantity;
                    $item->save();
                    return 200;
                }
            }
        } catch(\Exception $error) {}
        
        if($category && $category !== 'undefined' && !is_null($category)) {
            $category->inventory -= $request->quantity;
            $category->save();
        }

    }
}