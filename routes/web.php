<?php

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

use App\Http\Controllers\SellController;
use Hamcrest\Internal\SelfDescribingValue;

Route::name('product.')
    ->group(function () {
        Route::get('/', 'ProductController@index')->name('index');
        // 5-1Route::middleware('auth')
        Route::get('/product/{id}', 'ProductController@show')->name('show');
    });

Route::name('sell.')
    ->group(function () {
        Route::get('/sell', 'SellController@indexSellForm')->name('index');
        Route::get('/sell/create', 'SellController@createSellForm')->name('create');
        Route::post('/sell/store', 'SellController@storeSellForm')->name('store');
        Route::patch('/sell/{id}/update', 'SellController@updateSellForm')->name('update');
    });

Route::name('line_item.')
    ->group(function () {
        Route::post('/line_item/create', 'LineItemController@create')->name('create');
        Route::post('/line_item/delete', 'LineItemController@delete')->name('delete');
    });
Route::name('cart.')
    ->group(function () {
        Route::get('/cart', 'CartController@index')->name('index');
        Route::get('/cart/checkout', 'CartController@checkout')->name('checkout');
        Route::get('/cart/success', 'CartController@success')->name('success');
    });
