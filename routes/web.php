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
        'register' => true, // メール確認機能（※5.7系以上のみ）
        'reset'    => true, // デフォルトの登録機能
        'verify'   => false, // メールリマインダー機能OFF
    ]);
    Route::get('guest', 'Auth\LoginController@guestLogin')->name('login.guest');

    // ログイン認証後
    Route::middleware('auth:user')->group(function () {

        // TOPページ
        Route::resource('home', 'HomeController', ['only' => 'index']);
        //mypage
        Route::get('mypage/edit', 'ProfileController@edit')->name('mypage.edit');
        Route::post('mypage/edit', 'ProfileController@update')->name('mypage.update');
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

    Route::middleware('auth:user')->group(function () {
        Route::name('cart.')
            ->group(function () {
                Route::get('/cart', 'CartController@index')->name('index');
                Route::get('/cart/checkout', 'CartController@checkout')->name('checkout');
                Route::get('/cart/success', 'CartController@success')->name('success');
            });
    });

    Route::get('/inquiry/create', 'InquiryController@create')->name('inquiry.create');
    Route::post('/inquiry/store', 'InquiryController@store')->name('inquiry.store');
});
Route::namespace('Admin')->prefix('admin')->name('admin.')->group(function () {

    // ログイン認証関連
    Auth::routes([
        'register' => true, // メール確認機能（※5.7系以上のみ）
        'reset'    => true, // デフォルトの登録機能
        'verify'   => false, // メールリマインダー機能OFF
    ]);

    // ログイン認証後
    Route::middleware('auth:admin')->group(function () {

        // TOPページ
        Route::resource('home', 'HomeController', ['only' => 'index']);
        //Sell
        Route::resource('/product', 'SellController');

        Route::get('/sell', 'SellController@index')->name('sell.index');
        Route::get('/sell/create', 'SellController@create')->name('sell.create');
        Route::post('/sell/store', 'SellController@store')->name('sell.store');
        Route::get('/sell/{id}/edit', 'SellController@edit')->name('sell.edit');
        Route::patch('/sell/update/{id}', 'SellController@update')->name('sell.update');
        Route::delete('/sell/delete/{id}', 'SellController@destroy')->name('sell.destroy');

        //mypage
        Route::get('mypage/edit', 'ProfileController@edit')->name('mypage.edit');
        Route::post('mypage/edit', 'ProfileController@update')->name('mypage.update');
    });
});
