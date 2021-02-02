<?php

Route::group(['prefix' => 'v1', 'as' => 'api.', 'namespace' => 'Api\V1\Admin', 'middleware' => ['auth:api']], function () {
    // Permissions
    Route::apiResource('permissions', 'PermissionsApiController');

    // Roles
    Route::apiResource('roles', 'RolesApiController');

    // Users
    Route::apiResource('users', 'UsersApiController');
});

Route::group(['prefix' => 'axelrod', 'middleware' => ['guest'], 'as' => 'api.mpesa.', 'namespace' => 'Customer'], function (){
    Route::get('callback', 'StkCallbackResponseController@index')->name('quoute.stk_callback');
});
