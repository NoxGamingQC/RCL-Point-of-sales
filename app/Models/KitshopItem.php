<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class KitshopItem extends Model
{
    protected $table = 'kitshop_items';
    
    const CREATED_AT = 'created_at';
    const UPDATED_AT = 'updated_at';
}
