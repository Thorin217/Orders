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

//routes for inventory
Route::get('/inventories', 'Web\InventoryController@index')->name('inventories.index');
Route::get('/inventories/all', 'Web\InventoryController@listInventory')->name('inventories.list');
Route::get('/inventories/create', 'Web\InventoryController@create')->name('inventories.create');
Route::get('/inventories/{id}', 'Web\InventoryController@show')->name('inventories.show');
Route::get('/inventories/edit/{id}', 'Web\InventoryController@edit')->name('inventories.edit');
Route::put('/inventories', 'Web\InventoryController@destroy')->name('inventories.destroy');

//routes for customers
Route::get('/customers', 'Web\CustomerController@index')->name('customers.index');
Route::get('/customers/all', 'Web\CustomerController@listCustomer')->name('customers.list');
Route::get('/customers/create', 'Web\CustomerController@create')->name('customers.create');
Route::get('/customers/{id}', 'Web\CustomerController@show')->name('customers.show');
Route::get('/customers/edit/{id}', 'Web\CustomerController@edit')->name('customers.edit');
Route::put('/customers', 'Web\CustomerController@destroy')->name('customers.destroy');
