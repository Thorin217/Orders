<?php

use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    if(Auth::check()){
        return redirect()->route('home');
    }

    return view('auth.login');
});


Route::group(['prefix' => 'admin'], function () {
    Voyager::routes();
});

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');
Route::get('/orders', 'Web\OrderController@index')->name('orders.index');
Route::get('/customers', 'Web\CustomerController@index')->name('customers.index');

//routes for inventory
Route::get('/invetories', 'Web\InventoryController@index')->name('inventories.index');
Route::get('/inventories/all', 'Web\InventoryController@listInventory')->name('inventories.list');
