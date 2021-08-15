<?php

use Illuminate\Http\Request;



Route::post('/user/login', ['as' => 'api.user.login', 'uses' => 'Api\AuthMobileController@login']);
Route::post('/user/register', ['as' => 'api.user.register', 'uses' => 'Api\AuthMobileController@register']);

//xác thực access token
Route::group(['middleware' => 'auth:api'], function(){
    //user
    Route::get('/user/detail', ['as' => 'api.user.detail', 'uses' => 'Api\AuthMobileController@detail']);
    Route::post('/user/update', ['as' => 'api.user.update', 'uses' => 'Api\AuthMobileController@update']);
    Route::get('/user/list', ['as' => 'api.user.list', 'uses' => 'Api\AuthMobileController@list']);
    Route::post('/user/change-password', ['as' => 'api.user.change_password', 'uses' => 'Api\AuthMobileController@change_password']);
    Route::post('/user/request', ['as' => 'api.user.request', 'uses' => 'Api\AuthMobileController@request']);
    Route::post('/user/response', ['as' => 'api.user.response', 'uses' => 'Api\AuthMobileController@response']);
    //Friend
    Route::get('/friend/index', ['as' => 'api.user.list', 'uses' => 'Api\FriendController@index']);
    Route::get('/friend/request', ['as' => 'api.user.request', 'uses' => 'Api\FriendController@request']);
    Route::post('/friend/response/{request_id}', ['as' => 'api.user.response', 'uses' => 'Api\FriendController@response']);
    //dự án
    Route::get('/project/list', ['as' => 'api.project.show', 'uses' => 'Api\ProjectController@list']);
    Route::get('/project/detail', ['as' => 'api.project.detail', 'uses' => 'Api\ProjectController@detail']);
    Route::get('/project-detail/detail', ['as' => 'api.project.detail', 'uses' => 'Api\ProjectDetailController@detail']);
});