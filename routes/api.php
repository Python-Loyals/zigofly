<?php

Route::group(['prefix' => 'v1', 'as' => 'api.', 'namespace' => 'Api\V1\Admin', 'middleware' => ['auth:api']], function () {
    // Permissions
    Route::apiResource('permissions', 'PermissionsApiController');

    // Roles
    Route::apiResource('roles', 'RolesApiController');

    // Users
    Route::apiResource('users', 'UsersApiController');
});

Route::group(['prefix' => 'axelrod/callback', 'middleware' => ['guest'], 'as' => 'api.mpesa.', 'namespace' => 'Customer'], function (){
    Route::post('quote', 'StkCallbackResponseController@index')->name('quote.stk_callback');
    Route::post('order', 'StkCallbackResponseController@order')->name('order.stk_callback');
});
