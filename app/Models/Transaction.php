<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Transaction extends Model
{
    protected $table = 'bar_transactions';
    
    const CREATED_AT = 'created_at';
    const UPDATED_AT = 'updated_at';
}
