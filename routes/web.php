<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;

//Auth
Auth::routes();
Route::get('/logout', 'App\Http\Controllers\Auth\LogoutController@logout');

//Standard
Route::get('/', 'App\Http\Controllers\HomeController@index');

//POS
Route::get('/pos', 'App\Http\Controllers\POSController@index');
Route::post('/pos/validate/{pin}/{option}', 'App\Http\Controllers\POSController@validateCashier');
Route::get('/pos/menu/{cashier_id}', 'App\Http\Controllers\POSController@menu');
Route::get('/pos/kitshop/{cashier_id}', 'App\Http\Controllers\POSController@kitshop');
Route::get('/pos/getInventory/{itemID}', 'App\Http\Controllers\POSController@getInventoryCount');
Route::post('/pos/pay', 'App\Http\Controllers\POSController@save');
Route::post('/pos/invoice/edit', 'App\Http\Controllers\POSController@saveInvoice');
Route::post('/pos/inventory', 'App\Http\Controllers\POSController@sellInventory');

//Dashboard
Route::get('/dashboard', 'App\Http\Controllers\DashboardController@index');
Route::get('/transactions', 'App\Http\Controllers\DashboardController@transactions');
Route::get('/transactions/{firstDay}/{secondDay}', 'App\Http\Controllers\DashboardController@getTransactions');
Route::get('/reports/{firstDay}/{secondDay}', 'App\Http\Controllers\DashboardController@getReports');
Route::get('/inventory', 'App\Http\Controllers\DashboardController@getInventory');
Route::get('/items', 'App\Http\Controllers\DashboardController@items');
