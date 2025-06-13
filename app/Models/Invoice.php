<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class Invoice extends Model
{
    protected $table = 'invoices';
    
    const CREATED_AT = 'created_at';
    const UPDATED_AT = 'updated_at';

    public function getCustomerFullName() {
        $customer = DB::table('customers_list')
        ->where('id', '=', $this->customer_id)
        ->first();
        return $customer->firstname . ' ' . $customer->lastname ;
    }

    public function getCustomerFirstName() {
        $customer = DB::table('customers_list')
        ->where('id', '=', $this->customer_id)
        ->first();
        return $customer->firstname;
    }

    public function getCustomerLastName() {
        $customer = DB::table('customers_list')
        ->where('id', '=', $this->customer_id)
        ->first();
        return $customer->lastname;
    }

    public function getTotalPrice() {
        $amount = 0;
        $items = DB::table('bar_transactions')
        ->where('invoice_id', '=', $this->id)
        ->get();

        foreach($items as $item) {
            $amount += ($item->price * $item->quantity);
        }
        return number_format($amount,2);
    }
}
