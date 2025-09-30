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
        $initialQuery = $query;
        foreach($query->where('inventory', '!=', null)->get() as $category) {
            array_push($items,  [
                'name' => $category->name,
                'image' => $category->image,
                'inventory' => $category->inventory,
                'alert_threshold' => $category->inventory,
                'type' => 'category'
            ]);
        }
        foreach(Catalog::where('inventory', null)->get() as $category) {
            $itemsCollection = $category->getVariations();
            foreach($itemsCollection as $itemCollection) {
                if($itemCollection->inventory != null) {
                    array_push($items, [
                        'name' => $itemCollection->name,
                        'image' => $itemCollection->image,
                        'inventory' => $itemCollection->inventory,
                        'alert_threshold' => $itemCollection->alert_threshold,
                        'type' => 'item',
                    ]);
                }
            }
            
        }
        return $items;
    }

    public function getVariations() {
        return DB::table('bar_items')
            ->where('category_id', '=', $this->id)
            ->orderBy('id')
            ->get();
    }
}
