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


use Hamcrest\Internal\SelfDescribingValue;

Route::namespace('User')->prefix('user')->name('user.')->group(function () {

    // ログイン認証関連
    Auth::routes([
        'register' => true,
        'reset'    => true,
        'verify'   => false
    ]);

    // ログイン認証後
    Route::middleware('auth:user')->group(function () {

        // TOPページ
        Route::resource('home', 'HomeController', ['only' => 'index']);

    });

});
Route::namespace('User')->name('user.')->group(function () {
Route::name('product.')
    ->group(function () {
        Route::get('/', 'ProductController@index')->name('index');
        // 5-1Route::middleware('auth')
        Route::get('/product/{id}', 'ProductController@show')->name('show');
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
});
Route::namespace('Admin')->prefix('admin')->name('admin.')->group(function () {

    // ログイン認証関連
    Auth::routes([
        'register' => true,
        'reset'    => true,
        'verify'   => false
    ]);
    Route::resource('/product', 'SellController')->only(['create','show']);
    // ログイン認証後
    Route::middleware('auth:admin')->group(function () {
        Route::resource('/product', 'SellController')->except(['create','show']);
        // TOPページ
        Route::resource('home', 'HomeController', ['only' => 'index']);

    });

});












