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

Route::namespace('User')->group(function () {

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


Route::name('product.')
    ->group(function () {
        Route::get('/', 'User\ProductController@index')->name('index');
        // 5-1Route::middleware('auth')
        Route::get('/product/{id}', 'User\ProductController@show')->name('show');
    });




Route::name('line_item.')
    ->group(function () {
        Route::post('/line_item/create', 'User\LineItemController@create')->name('create');
        Route::post('/line_item/delete', 'User\LineItemController@delete')->name('delete');
    });
Route::name('cart.')
    ->group(function () {
        Route::get('/cart', 'User\CartController@index')->name('index');
        Route::get('/cart/checkout', 'User\CartController@checkout')->name('checkout');
        Route::get('/cart/success', 'User\CartController@success')->name('success');
    });



Route::namespace('Admin')->group(function () {

    // ログイン認証関連
    Auth::routes([
        'register' => true,
        'reset'    => true,
        'verify'   => false
    ]);

    // ログイン認証後
    Route::middleware('auth:admin')->group(function () {

        // TOPページ
        Route::resource('home', 'HomeController', ['only' => 'index']);

    });

});

Route::resource('/', 'Admin\SellController');



