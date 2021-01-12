<?php

use Illuminate\Support\Facades\Auth;

Route::redirect('/', '/login');
Route::get('/home', function () {
    if (session('status')) {
        return redirect()->route('customer.home')->with('status', session('status'));
    }

    return redirect()->route('customer.home');
});

Auth::routes(['register' => true]);
// Customer

Route::group(['prefix' => 'user', 'as' => 'customer.', 'namespace' => 'Customer', 'middleware' => ['auth', 'cart.init']], function () {
    Route::get('/', 'HomeController@index')->name('home');

    Route::get('/shop', 'HomeController@shop')->name('shop');
    // Permissions
    Route::delete('permissions/destroy', 'PermissionsController@massDestroy')->name('permissions.massDestroy');
    Route::resource('permissions', 'PermissionsController');

    // Roles
    Route::delete('roles/destroy', 'RolesController@massDestroy')->name('roles.massDestroy');
    Route::resource('roles', 'RolesController');

    // Users
    Route::delete('users/destroy', 'UsersController@massDestroy')->name('users.massDestroy');
    Route::resource('users', 'UsersController');

    // Customer adrress
    Route::get('address', 'AddressController@index')->name('users.address');

    //Customer Shipments
    Route::get('shipments', function (){
        return view('customer.shipments.index');
    })->name('users.shipments');

    //Customer Orders
    Route::group(['as' => 'users.'], function (){
        Route::get('orders', 'OrdersController@index')->name('orders');
        Route::get('orders/store', 'OrdersController@store')->name('orders.store');
        Route::get('order/{order_id}', 'OrdersController@show')->name('orders.show');
    });

    //customer quotes
    Route::get('quotes', 'QuotesController@index')->name('users.quotes');
    Route::post('quote', 'QuotesController@store')->name('users.quotes.store');
    Route::get('quote/{id}', 'QuotesController@show')->name('users.quotes.show');

    Route::get('calculator', function (){
        return view('customer.rate_calculator.index');
    })->name('users.calculator');

    Route::get('packages', function (){
        return view('customer.packages.index');
    })->name('users.packages');

    Route::get('package', function (){
        return view('customer.packages.package');
    })->name('users.single_package');

    //user profile
    Route::get('profile','ProfileController@index')->name('profile.index');
    Route::put('profile','ProfileController@update')->name('profile.update_info');
    Route::put('profile/avatar','ProfileController@updateAvatar')->name('profile.update_avatar');
});

Route::group(['prefix' => 'products', 'as' => 'products.', 'namespace' => 'Product', 'middleware' => ['auth'] ], function (){
    Route::get('category/{search_term}', 'ProductsController@index')->name('category.search');
    Route::get('search', 'ProductsController@search')->name('search');
});

Route::group(['prefix' => 'product', 'as' => 'product.', 'namespace' => 'Product', 'middleware' => ['auth', 'cart.init'] ], function (){
    Route::post('store', 'ProductController@store')->name('store');
    Route::get('asin/{asin}', 'ProductController@show')->name('show');
});

Route::group(['prefix' => 'cart', 'as' => 'cart.', 'namespace' => 'Cart', 'middleware' => ['auth', 'cart.init'] ], function (){
    Route::get('/', 'CartController@index')->name('index');
    Route::put('quantity', 'CartController@updateQuantity')->name('quantity.update');
    Route::delete('delete/{rowId}', 'CartController@destroy')->name('product.delete');
    Route::post('/add', 'CartController@store')->name('add');
    Route::get('/checkout', 'CartController@checkout')->name('checkout');
});

Route::group(['prefix' => 'profile', 'as' => 'profile.', 'namespace' => 'Auth', 'middleware' => ['auth', 'cart.init']], function () {
// Change password
    if (file_exists(app_path('Http/Controllers/Auth/ChangePasswordController.php'))) {
        Route::get('password', 'ChangePasswordController@edit')->name('password.edit');
        Route::put('password', 'ChangePasswordController@update')->name('password.update');
    }
});


//admin

//admin auth
Route::group(['prefix' => 'admin', 'as' => 'admin.', 'namespace' => 'Auth'],function(){

    //Login Routes
    Route::get('/login','LoginController@showAdminLoginForm');
    Route::post('/login','LoginController@adminLogin')->name('login');
    Route::post('/logout','LoginController@adminLogout')->name('logout');

    //Forgot Password Routes
    Route::get('/password/reset','Admin\ForgotPasswordController@showLinkRequestForm')->name('password.request');
    Route::post('/password/email','Admin\ForgotPasswordController@sendResetLinkEmail')->name('password.email');

    //Reset Password Routes
    Route::get('/password/reset/{token}','Admin\ResetPasswordController@showResetForm')->name('password.reset');
    Route::post('/password/reset','Admin\ResetPasswordController@reset')->name('password.update');

});

Route::group(['prefix' => 'admin', 'as' => 'admin.', 'namespace' => 'Admin', 'middleware' => ['auth:admin']], function () {
    Route::get('home', 'HomeController@index')->name('home');

    // Customers
//    Route::delete('customers/destroy', 'UsersController@massDestroy')->name('users.massDestroy');
    Route::resource('customers', 'CustomersController');

    //Customer orders
    Route::resource('orders', 'OrdersController');
});
