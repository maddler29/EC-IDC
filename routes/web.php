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

use App\Http\Controllers\AdminSellController;
use Hamcrest\Internal\SelfDescribingValue;

Route::name('product.')
    ->group(function () {
        Route::get('/', 'ProductController@index')->name('index');
        // 5-1Route::middleware('auth')
        Route::get('/product/{id}', 'ProductController@show')->name('show');
    });

// 管理者出品画面
Route::group(['prefix' => 'AdminSell', 'as' => 'AdminSell.'], function () {
    Route::get('/', 'AdminSellController@indexAdminSellForm')->name('index');
    Route::get('/create', 'AdminSellController@createAdminSellForm')->name('create');
    Route::post('/store', 'AdminSellController@storeAdminSellForm')->name('store');
    Route::patch('/{id}/update', 'AdminSellController@updateAdminSellForm')->name('update');
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
