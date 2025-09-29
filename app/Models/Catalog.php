<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class Catalog extends Model
{
    protected $table = 'bar_item_category';
    public $timestamps = false;

    public function getQuantity() {
        $itemList = DB::table('bar_items')
            ->where('category_id', '=', $this->id)
            ->get();
        return count($itemList);
    }

    public static function scopeAllItemList($query) {
        $items = [];
        foreach($query->where('inventory', '!=', null)->get() as $category) {
            $item = [
                'name' => $category->name,
                'image' => $category->image,
                'inventory' => $category->inventory,
                'alert_threshold' => $category->inventory,
                'type' => 'category'
            ];
            array_push($items, $item);
        }
        dd($items);
        return $items;
    }

    public function getVariations() {
        return DB::table('bar_items')
            ->where('category_id', '=', $this->id)
            ->orderBy('id')
            ->get();
    }
}
