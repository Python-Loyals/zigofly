<?php

Route::redirect('/', '/login');
Route::get('/home', function () {
    if (session('status')) {
        return redirect()->route('admin.home')->with('status', session('status'));
    }

    return redirect()->route('admin.home');
});

Auth::routes(['register' => true]);
// Admin

Route::group(['prefix' => 'admin', 'as' => 'admin.', 'namespace' => 'Admin', 'middleware' => ['auth']], function () {
    Route::get('/', 'HomeController@index')->name('home');
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

    //user profile
    Route::get('profile','ProfileController@index')->name('profile.index');
    Route::put('profile','ProfileController@update')->name('profile.update_info');
    Route::put('profile/avatar','ProfileController@updateAvatar')->name('profile.update_avatar');
});

Route::group(['prefix' => 'products', 'as' => 'products.', 'namespace' => 'Product', 'middleware' => ['auth'] ], function (){
    Route::get('category/{search_term}', 'ProductsController@index')->name('category.search');
});

Route::group(['prefix' => 'product', 'as' => 'product.', 'namespace' => 'Product', 'middleware' => ['auth'] ], function (){
    Route::post('store', 'ProductController@store')->name('store');
    Route::get('asin/{asin}', 'ProductController@show')->name('show');
});

Route::group(['prefix' => 'profile', 'as' => 'profile.', 'namespace' => 'Auth', 'middleware' => ['auth']], function () {
// Change password
    if (file_exists(app_path('Http/Controllers/Auth/ChangePasswordController.php'))) {
        Route::get('password', 'ChangePasswordController@edit')->name('password.edit');
        Route::put('password', 'ChangePasswordController@update')->name('password.update');
    }
});
