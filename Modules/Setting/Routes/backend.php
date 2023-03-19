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
Route::prefix('setting')->group(function() {
    Route::get('/', [
        'as' => 'admin.setting.index',
        'uses' => 'settingController@index',
        'middleware' => 'can:admin.setting.index'
    ]);

});