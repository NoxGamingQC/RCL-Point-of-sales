<?php

use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    abort(503);
});

Route::get('/pos', 'App\Http\Controllers\POSController@index');
Route::post('/pos/validate/{pin}/{option}', 'App\Http\Controllers\POSController@validateCashier');
Route::get('/pos/menu/{cashier_id}', 'App\Http\Controllers\POSController@menu');
Route::get('/pos/getInventory/{itemID}', 'App\Http\Controllers\POSController@getInventoryCount');
Route::post('/pos/pay', 'App\Http\Controllers\POSController@save');