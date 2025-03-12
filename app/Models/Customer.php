<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Customer extends Model
{
    protected $table = 'customers_list';
    
    const CREATED_AT = 'created_at';
    const UPDATED_AT = 'updated_at';
}
