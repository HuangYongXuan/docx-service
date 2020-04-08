<?php

Route::group(['prefix' => 'auth'], function () {
    Route::post('token', 'Api\ApiAuthController@login');
    Route::post('refresh', 'Api\ApiAuthController@refreshToken')->middleware('api-auth');
    Route::post('destroy', 'Api\ApiAuthController@destroy')->middleware(['api-auth']);
    Route::group(['prefix' => 'user'], function () {
        Route::get('info', 'Api\Auth\UserController@info');
    });
});
