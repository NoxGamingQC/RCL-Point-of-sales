<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class KitshopTransaction extends Model
{
    protected $table = 'kitshop_transactions';
    
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
            $item = DB::table('kitshop_items')
                    ->where('id', '=', $this->item_id)
                    ->first()->name;

        }
        return $item;
    }

    public function scopeTotalCount($query) {
        $totalPrice = 0;
        foreach($query->where('is_canceled', false)->get() as $transaction) {
            $totalPrice += ($transaction->price * $transaction->quantity);
        }
        
        return $totalPrice;
    }

    public function scopeCountByItem($query, $itemId, $isPromotion = false) {
        $totalPrice = 0;
        foreach($query->where('is_canceled', false)->where('item_id', $itemId)->where('is_promotion', $isPromotion)->get() as $transaction) {
            $totalPrice += ($transaction->price * $transaction->quantity);
        }
        
        return $totalPrice;
    }

    public function scopeQuantityByItem($query, $itemId) {
        $quantity = 0;
        foreach($query->where('is_canceled', false)->where('item_id', $itemId)->get() as $transaction) {
            $quantity += $transaction->quantity;
        }
        
        return $quantity;
    }
}
