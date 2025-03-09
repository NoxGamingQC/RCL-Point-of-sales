<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use App\Model\API\ApiKey;
use Square\Exceptions\ApiException;
use Carbon\Carbon;
use App\Models\Pin;
use App\Models\Catalog;
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
            if($cashier) {
                return view('menu')->with([
                    'name' => env('NAME'),
                    'image' => env('LOGO'),
                    'phone_number'=> env('PHONE_NUMBER'),
                    'catalog' => $category->sortBy('id'),
                    'catalogImages' => isset($catalogImages) ? $catalogImages->getObjects() : [],
                    'invoices' => isset($invoices) ? $invoices : [],
                    'cashierName' => isset($cashier->lastname) ? ($cashier->firstname . ' ' . $cashier->lastname[0] . '.') : $cashier->firstname
                ]);
            }
        return redirect('/pos/');
    }
}