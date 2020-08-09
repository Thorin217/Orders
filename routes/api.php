<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\TypeCustomer;
use App\PaymentType;
use App\DeliveryType;
use App\Inventory;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});


Route::group(['prefix' => 'auth'], function () {
    Route::post('login', 'Api\AuthController@login');
    //Route::post('signup', 'Api\AuthController@signup');

    Route::group(['middleware' => 'auth:api'], function() {
        Route::get('logout', 'Api\AuthController@logout');
        Route::get('user', 'Api\AuthController@user');
    });
});

//routes for inventory
Route::resource('inventory', 'Api\InventoryController');
Route::put('inventory/delete/all', 'Api\InventoryController@destroyAll')->name('inventory.delete.all');

//routes for customers
Route::resource('customer', 'Api\CustomerController');

//routes for orders
Route::resource('order', 'Api\OrderController');
Route::get('resources', function () {
    return response()->json([
        'payments'      =>  PaymentType::select('name','id')->get(),
        'deliveries'     =>  DeliveryType::select('name','id')->get(),
        'types'         =>  TypeCustomer::select('name','id')->get()
    ]);
});

Route::put('order-state/{id}', 'Api\OrderController@changeStatus');

//routes fot users
Route::resource('user', 'Api\UserController');
