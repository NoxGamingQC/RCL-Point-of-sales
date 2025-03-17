<?php

use Illuminate\Support\Facades\Route;

Route::get('/pos', 'App\Http\Controllers\POSController@index');
Route::post('/pos/validate/{pin}/{option}', 'App\Http\Controllers\POSController@validateCashier');
Route::get('/pos/menu/{cashier_id}', 'App\Http\Controllers\POSController@menu');
Route::get('/pos/getInventory/{itemID}', 'App\Http\Controllers\POSController@getInventoryCount');
Route::post('/pos/pay', 'App\Http\Controllers\POSController@save');
Route::post('/pos/inventory', 'App\Http\Controllers\POSController@sellInventory');

Auth::routes();


Route::get('/', function () {
    return redirect('/login');
});

Route::get('/home', function () {
    return redirect('/dashboard');
});

Route::get('/dashboard', 'App\Http\Controllers\DashboardController@index');
Route::get('/transactions', 'App\Http\Controllers\DashboardController@transactions');
Route::get('/transactions/{firstDay}/{secondDay}', 'App\Http\Controllers\DashboardController@getTransactions');
Route::get('/reports/{firstDay}/{secondDay}', 'App\Http\Controllers\DashboardController@getReports');
