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

    Route::get('account', 'UserController@index')->name('account');
    Route::get('account/create', 'UserController@create')->name('account.create');
    Route::post('account/store', 'UserController@store')->name('account.store');
    Route::get('account/edit/{id}', 'UserController@edit')->name('account.edit');
    Route::post('account/update/{id}', 'UserController@update')->name('account.update');
    Route::post('account/delete/{id}', 'UserController@destroy')->name('account.delete');

    Route::get('categories', 'CateController@index')->name('categories');
    Route::get('categories/create', 'CateController@create')->name('categories.create');
    Route::post('categories/store', 'CateController@store')->name('categories.store');
    Route::get('categories/edit/{id}', 'CateController@edit')->name('categories.edit');
    Route::post('categories/update/{id}', 'CateController@update')->name('categories.update');
    Route::post('categories/delete/{id}', 'CateController@destroy')->name('categories.delete');

    Route::get('sub-categories', 'SubCateController@index')->name('sub-categories');
    Route::get('sub-categories/create', 'SubCateController@create')->name('sub-categories.create');
    Route::post('sub-categories/store', 'SubCateController@store')->name('sub-categories.store');
    Route::get('sub-categories/edit/{id}', 'SubCateController@edit')->name('sub-categories.edit');
    Route::post('sub-categories/update/{id}', 'SubCateController@update')->name('sub-categories.update');
    Route::post('sub-categories/delete/{id}', 'SubCateController@destroy')->name('sub-categories.delete');
});
