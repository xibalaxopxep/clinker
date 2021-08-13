<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */


Route::group(['prefix' => 'admin', 'middleware' => 'admin'], function() {
    Route::get('/', ['as' => 'admin.index', 'uses' => 'Backend\BackendController@index']);
    /* Cấu hình website */
    Route::get('/config', ['as' => 'admin.config.index', 'uses' => 'Backend\ConfigController@index']);
    Route::post('/config/update/{id}', ['as' => 'admin.config.update', 'uses' => 'Backend\ConfigController@update']);


    /* Quản lý dự án */
    Route::get('/project', ['as' => 'admin.project.index', 'uses' => 'Backend\ProjectController@index']);
    Route::get('/project/create', ['as' => 'admin.project.create', 'uses' => 'Backend\ProjectController@create']);
    Route::post('/project/store', ['as' => 'admin.project.store', 'uses' => 'Backend\ProjectController@store']);
    Route::get('/project/edit/{id}', ['as' => 'admin.project.edit', 'uses' => 'Backend\ProjectController@edit']);
    Route::post('/project/update/{id}', ['as' => 'admin.project.update', 'uses' => 'Backend\ProjectController@update']);
    Route::delete('/project/delete/{id}', ['as' => 'admin.project.destroy', 'uses' => 'Backend\ProjectController@destroy']);

   
    /* Quản lý user */
    Route::get('/user', ['as' => 'admin.user.index', 'uses' => 'Backend\UserController@index']);
    Route::get('/user/create', ['as' => 'admin.user.create', 'uses' => 'Backend\UserController@create']);
    Route::post('/user/store', ['as' => 'admin.user.store', 'uses' => 'Backend\UserController@store']);
    Route::get('/user/edit/{id}', ['as' => 'admin.user.edit', 'uses' => 'Backend\UserController@edit']);
    Route::post('/user/update/{id}', ['as' => 'admin.user.update', 'uses' => 'Backend\UserController@update']);
    Route::delete('/user/delete/{id}', ['as' => 'admin.user.destroy', 'uses' => 'Backend\UserController@destroy']);

    Route::get('/user/edit_profile/{id}', ['as' => 'admin.user.index_profile', 'uses' => 'Backend\UserController@editProfile']);
    Route::post('/user/update_profile/{id}', ['as' => 'admin.user.update_profile', 'uses' => 'Backend\UserController@updateProfile']);
    /* Quản lý quyền */
    Route::get('/role', ['as' => 'admin.role.index', 'uses' => 'Backend\RoleController@index']);
    Route::get('/role/create', ['as' => 'admin.role.create', 'uses' => 'Backend\RoleController@create']);
    Route::post('/role/store', ['as' => 'admin.role.store', 'uses' => 'Backend\RoleController@store']);
    Route::get('/role/edit/{id}', ['as' => 'admin.role.edit', 'uses' => 'Backend\RoleController@edit']);
    Route::post('/role/update/{id}', ['as' => 'admin.role.update', 'uses' => 'Backend\RoleController@update']);
    Route::delete('/role/delete/{id}', ['as' => 'admin.role.destroy', 'uses' => 'Backend\RoleController@destroy']);

    /* Menu*/
    Route::get('/menu', ['as' => 'admin.menu.index', 'uses' => 'Backend\MenuController@index']);
    Route::get('/menu/create', ['as' => 'admin.menu.create', 'uses' => 'Backend\MenuController@create']);
    Route::get('/menu/edit/{id}', ['as' => 'admin.menu.edit', 'uses' => 'Backend\MenuController@edit']);
    Route::post('/menu/store', ['as' => 'admin.menu.store', 'uses' => 'Backend\MenuController@store']);
    Route::post('/menu/update/{id}', ['as' => 'admin.menu.update', 'uses' => 'Backend\MenuController@update']);
    Route::delete('/menu/delete/{id}', ['as' => 'admin.menu.destroy', 'uses' => 'Backend\MenuController@destroy']);
    /* Block*/
    Route::get('/block', ['as' => 'admin.block.index', 'uses' => 'Backend\BlockController@index']);
    Route::get('/block/create', ['as' => 'admin.block.create', 'uses' => 'Backend\BlockController@create']);
    Route::get('/block/edit/{id}', ['as' => 'admin.block.edit', 'uses' => 'Backend\BlockController@edit']);
    Route::post('/block/store', ['as' => 'admin.block.store', 'uses' => 'Backend\BlockController@store']);
    Route::post('/block/update/{id}', ['as' => 'admin.block.update', 'uses' => 'Backend\BlockController@update']);
    Route::delete('/block/delete/{id}', ['as' => 'admin.block.destroy', 'uses' => 'Backend\BlockController@destroy']);
    /* Slide*/
    Route::get('/slide', ['as' => 'admin.slide.index', 'uses' => 'Backend\SlideController@index']);
    Route::get('/slide/create', ['as' => 'admin.slide.create', 'uses' => 'Backend\SlideController@create']);
    Route::get('/slide/edit/{id}', ['as' => 'admin.slide.edit', 'uses' => 'Backend\SlideController@edit']);
    Route::post('/slide/store', ['as' => 'admin.slide.store', 'uses' => 'Backend\SlideController@store']);
    Route::post('/slide/update/{id}', ['as' => 'admin.slide.update', 'uses' => 'Backend\SlideController@update']);
    Route::delete('/slide/delete/{id}', ['as' => 'admin.slide.destroy', 'uses' => 'Backend\SlideController@destroy']);
    /* Dịch vụ*/

    Route::get('/contact', ['as' => 'admin.contact.index', 'uses' => 'Backend\ContactController@index']);
    Route::delete('/contact/delete/{id}', ['as' => 'admin.contact.destroy', 'uses' => 'Backend\ContactController@destroy']);
    Route::get('/contact/show/{id}', ['as' => 'admin.contact.edit', 'uses' => 'Backend\ContactController@show']);
    /* Thành viên*/
    Route::get('/member', ['as' => 'admin.member.index', 'uses' => 'Backend\MemberController@index']);
    Route::delete('/member/delete/{id}', ['as' => 'admin.member.destroy', 'uses' => 'Backend\MemberController@destroy']);
    Route::get('/member/create', ['as' => 'admin.member.create', 'uses' => 'Backend\MemberController@create']);
    Route::post('/member/store', ['as' => 'admin.member.store', 'uses' => 'Backend\MemberController@store']);
    Route::get('/member/edit/{id}', ['as' => 'admin.member.edit', 'uses' => 'Backend\MemberController@edit']);
    Route::post('/member/update/{id}', ['as' => 'admin.member.update', 'uses' => 'Backend\MemberController@update']);
    Route::get('/member/show/{id}', ['as' => 'admin.member.show', 'uses' => 'Backend\MemberController@show']);

    /*Nhóm thành viên*/
    Route::get('/group', ['as' => 'admin.group.index', 'uses' => 'Backend\GroupController@index']);
    Route::delete('/group/delete/{id}', ['as' => 'admin.group.destroy', 'uses' => 'Backend\GroupController@destroy']);
    Route::get('/group/create', ['as' => 'admin.group.create', 'uses' => 'Backend\GroupController@create']);
    Route::post('/group/store', ['as' => 'admin.group.store', 'uses' => 'Backend\GroupController@store']);
    Route::get('/group/edit/{id}', ['as' => 'admin.group.edit', 'uses' => 'Backend\GroupController@edit']);
    Route::post('/group/update/{id}', ['as' => 'admin.group.update', 'uses' => 'Backend\GroupController@update']);
    

});
