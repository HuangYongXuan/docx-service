<?php


Route::group(['prefix' => 'auth'], function () {
    Route::post('token', 'Api\ApiAuthController@login');
    Route::post('refresh', 'Api\ApiAuthController@refreshToken')->middleware('api-auth');
    Route::post('destroy', 'Api\ApiAuthController@destroy')->middleware(['api-auth']);
});

Route::apiResources([
    'documents' => 'Api\DocumentController',
    'documentChapter' => 'Api\DocumentChapterController',
], ['middleware' => 'api-auth']);
