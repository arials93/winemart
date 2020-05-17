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

Route::namespace('Store')->name('store.')->group(function () {
    Route::get('/', 'StoreController@index')->name('home');
    Route::get('products', 'ProductController@index')->name('products');
    Route::get('category/{cate_id}/products', 'ProductController@index')->name('category.products');
    Route::get('products/{id}', 'ProductController@product')->name('product');
    Route::get('blogs/{id}', 'BlogController@index')->name('blogs');
    Route::get('blog/{id}', 'BlogController@blog')->name('blog');

    Route::get('cart', 'CartController@index')->name('cart');
    Route::get('checkout', 'CartController@checkout')->name('checkout');

    Route::view('contact', 'store.contact')->name('contact');
    Route::view('about', 'store.about')->name('about');

    Route::prefix('account')->name('account.')->group(function () {
        Route::view('info', 'store.account.info-user')->name('info');
        Route::get('edit', 'UserController@edit')->name('edit');
        Route::post('update', 'UserController@update')->name('update');
    });

    Route::prefix('cart')->name('cart.')->group(function () {
        Route::get('cart', 'CartController@index')->name('index');
        Route::get('ajax', 'CartController@ajax_index')->name('ajax');
        Route::post('add/{product_id}', 'CartController@add')->name('add');
        Route::post('update/{row_id}', 'CartController@update')->name('update');
        Route::post('delete/{row_id}', 'CartController@delete')->name('delete');
        Route::post('order', 'CartController@order')->name('order');
        Route::get('order-complete', 'CartController@order_complete')->name('order-complete');
    });
    
});

Route::namespace('Manager')->prefix('managers')->name('manager.')->group(function(){
    Route::get('/', 'DashboardController@index')->name('dashboard');
    Route::get('activities', 'DashboardController@show_activities')->name('activities');
    Route::get('orders/{tab}', 'OrderController@index')->name('orders');
    Route::get('orders/edit/{id}', 'OrderController@edit')->name('orders.edit');
    Route::get('orders', 'OrderController@index')->name('orders.search');
    Route::post('orders/delete/{id}', 'OrderController@destroy')->name('orders.delete');
    Route::post('orders/confirm/{id}', 'OrderController@confirm')->name('orders.confirm');
    Route::post('orders/delivery/{id}', 'OrderController@delivery')->name('orders.delivery');
    Route::post('orders/received/{id}', 'OrderController@received')->name('orders.received');

    $route_array = [
        'account' => 'UserController',
        'categories' => 'CateController',
        'sub-categories' => 'SubCateController',
        'sizes' => 'SizeController',
        'countries' => 'CountryController',
        'brands' => 'BrandController',
        'products' => 'ProductController',
        'blog-categories' => 'BlogCategoryController',
        'blogs' => 'BlogController',
    ];

    foreach($route_array as $route => $controller) {
        Route::get($route, $controller.'@index')->name($route);
        Route::get($route.'/create', $controller.'@create')->name($route.'.create');
        Route::post($route.'/store', $controller.'@store')->name($route.'.store');
        Route::get($route.'/edit/{id}', $controller.'@edit')->name($route.'.edit');
        Route::post($route.'/update/{id}', $controller.'@update')->name($route.'.update');
        Route::post($route.'/delete/{id}', $controller.'@destroy')->name($route.'.delete');
    }
});

Auth::routes();
