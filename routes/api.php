<?php

use Illuminate\Http\Request;


Route::post('/user/login', ['as' => 'api.user.login', 'uses' => 'Api\AuthMobileController@login']);
Route::post('/user/register', ['as' => 'api.user.register', 'uses' => 'Api\AuthMobileController@register']);

//xác thực access token
Route::group(['middleware' => 'auth:api'], function(){
    // get sà lan
    Route::get('/lighter/index', ['as' => 'api.lighter.index', 'uses' => 'Api\ProjectDetailController@getLighter']);
    // lấy danh sách địa điểm
    Route::get('/address/index', ['as' => 'api.address.index', 'uses' => 'Api\AddressController@index']);
    //phuong thuc thanh toan
    Route::get('/payment/index', ['as' => 'api.payment.index', 'uses' => 'Api\ProjectController@payment']);
    //user
    Route::get('/user/detail', ['as' => 'api.user.detail', 'uses' => 'Api\AuthMobileController@detail']);
    Route::post('/user/update', ['as' => 'api.user.update', 'uses' => 'Api\AuthMobileController@update']);
    Route::get('/user/list', ['as' => 'api.user.list', 'uses' => 'Api\AuthMobileController@list']);
    Route::post('/user/change-password', ['as' => 'api.user.change_password', 'uses' => 'Api\AuthMobileController@change_password']);
    Route::post('/user/request', ['as' => 'api.user.request', 'uses' => 'Api\AuthMobileController@request']);
    Route::get('/user/findByEmail', ['as' => 'api.user.findByEmail', 'uses' => 'Api\AuthMobileController@findByEmail']);
    Route::post('/user/upload/image', ['as' => 'api.user.upload_image', 'uses' => 'Api\AuthMobileController@upload_image']);

    //Friend
    Route::get('/friend/index', ['as' => 'api.friend.list', 'uses' => 'Api\FriendController@index']);
    Route::get('/friend/request', ['as' => 'api.friend.request', 'uses' => 'Api\FriendController@request']);
    Route::post('/friend/response', ['as' => 'api.friend.response', 'uses' => 'Api\FriendController@response']);
    Route::get('/friend/requested', ['as' => 'api.friend.requested', 'uses' => 'Api\FriendController@requested']);
    //dự án
    Route::post('/project/store', ['as' => 'api.project.store', 'uses' => 'Api\ProjectController@store']);
    Route::get('/project/index', ['as' => 'api.project.index', 'uses' => 'Api\ProjectController@index']);
    Route::get('/project/show', ['as' => 'api.project.show', 'uses' => 'Api\ProjectController@show']);
    Route::post('/project/update', ['as' => 'api.project.update', 'uses' => 'Api\ProjectController@update']);
    Route::post('/project/destroy', ['as' => 'api.project.destroy', 'uses' => 'Api\ProjectController@destroy']);
    Route::get('/project/findByStatus', ['as' => 'api.project.findByStatus', 'uses' => 'Api\ProjectController@findByStatus']);
    // chi tiết dự án
    Route::post('/project-detail/store', ['as' => 'api.project_detail.store', 'uses' => 'Api\ProjectDetailController@store']);
    Route::get('/project-detail/index', ['as' => 'api.project_detail.index', 'uses' => 'Api\ProjectDetailController@index']);
    Route::get('/project-detail/show', ['as' => 'api.project_detail.show', 'uses' => 'Api\ProjectDetailController@show']);
    Route::post('/project-detail/update', ['as' => 'api.project_detail.update', 'uses' => 'Api\ProjectDetailController@update']);
    //Nhân viên trong dự án
    Route::get('/project/user/index', ['as' => 'api.project_user.index', 'uses' => 'Api\UserController@index']);
    Route::get('/project/user/findByEmail', ['as' => 'api.project_user.findByEmail', 'uses' => 'Api\UserController@findByEmail']);

    
});