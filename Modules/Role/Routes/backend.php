<?php

/******************
//  api route create by SURANI AJIT
//  suraniajit128335@gmail.com
//  9737123443
******************/

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


Route::prefix('role')->group(function() {
    Route::get('/', [
        'as' => 'admin.role.index',
        'uses' => 'RoleController@index',
        'middleware' => 'can:admin.role.index'
    ]);
    Route::get('/permission', [
        'as' => 'admin.permission.index',
        'uses' => 'PermissionController@index',
        'middleware' => 'can:admin.permission.index'
    ]);
    Route::get('/permission-manage/{role_name}', [
        'as' => 'admin.role.permission-manage',
        'uses' => 'RoleController@getPeramissionManage',
        'middleware' => 'can:admin.role.permission_change'
    ]);
});