<?php

/******************
//  api route create by SURANI AJIT
//  suraniajit128335@gmail.com
//  9737123443
******************/

/*
|--------------------------------------------------------------------------
| Web  Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/
Route::get('/test', [
    'uses' => 'UserController@test',
]);


Route::prefix('user')->group(function() {
    Route::get('/', [
        'as' => 'admin.user.index',
        'uses' => 'UserController@index',
        'middleware' => 'can:admin.user.index'
    ]);
});
Route::get('/login', [
    'as' => 'admin.backend.login',
    'uses' => 'AuthController@login',
]);
Route::post('/login', [
    'as' => 'admin.backend.login_check',
    'uses' => 'AuthController@loginCheck',
]);
Route::post('/logout', [
    'as' => 'admin.backend.logout',
    'uses' => 'AuthController@logout',
]);
