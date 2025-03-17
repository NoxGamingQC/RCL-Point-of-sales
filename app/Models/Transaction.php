<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class Transaction extends Model
{
    protected $table = 'bar_transactions';
    
    const CREATED_AT = 'created_at';
    const UPDATED_AT = 'updated_at'; 

    public function getCashier() {
        $cashier = DB::table('pin')
                ->where('id', '=', $this->cashier_id)
                ->first();
        return $cashier->firstname . ' ' . $cashier->lastname;
    }

    public function getItemName () {
        if ($this->item_id) {
            $item = DB::table('bar_items')
                    ->where('id', '=', $this->item_id)
                    ->first()->name;

        } else {
            $item = DB::table('bar_item_category')
                    ->where('id', '=', $this->category_id)
                    ->first()->fullname;
        }
        return $item;
    }

    public function getCategoryName() {
        $item = DB::table('bar_item_category')
                ->where('id', '=', $this->category_id)
                ->first();
        return $item->fullname;
    }

    public function scopeTotalCount($query) {
        $totalPrice = 0;
        foreach($query->where('is_canceled', false)->get() as $transaction) {
            $totalPrice += ($transaction->price * $transaction->quantity);
        }
        
        return $totalPrice;
    }

    public function scopeCountByCategory($query, $categoryId) {
        $totalPrice = 0;
        foreach($query->where('is_canceled', false)->where('category_id', $categoryId)->get() as $transaction) {
            $totalPrice += ($transaction->price * $transaction->quantity);
        }
        
        return $totalPrice;
    }

    public function scopeCountByItem($query, $itemId) {
        $totalPrice = 0;
        foreach($query->where('is_canceled', false)->where('item_id', $itemId)->get() as $transaction) {
            $totalPrice += ($transaction->price * $transaction->quantity);
        }
        
        return $totalPrice;
    }
}
