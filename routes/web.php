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

Auth::routes();


Route::namespace('Store')->name('store.')->group(function () {
    Route::get('/', 'StoreController@index');
    Route::get('/products', 'ProductController@index')->name('products');
    Route::get('/products/{id}', 'ProductController@product')->name('product');
    Route::get('/blogs', 'BlogController@index')->name('blogs');
    Route::get('/blogs/{id}', 'BlogController@blog')->name('blog');

    Route::get('/cart', 'CartController@index')->name('cart');
    Route::get('/checkout', 'CartController@checkout')->name('checkout');

    Route::view('/contact', 'store.contact');
    Route::view('/about', 'store.about');

    Route::prefix('account')->name('account.')->group(function () {
        Route::view('/info', 'store.account.info-user')->name('info');
        Route::get('/edit', 'UserController@edit')->name('edit');
        Route::post('/update', 'UserController@update')->name('update');
    });
    
});

Route::namespace('Manager')->prefix('managers')->name('manager.')->group(function(){
    Route::get('/', 'DashboardController@index')->name('dashboard');
});
