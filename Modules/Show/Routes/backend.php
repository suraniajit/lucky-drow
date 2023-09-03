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
Route::prefix('show')->group(function() {
    Route::get('/', [
        'as' => 'admin.show.index',
        'uses' => 'ShowController@index',
        'middleware' => 'can:admin.show.index'
    ]);
    Route::get('/booking', [
        'as' => 'admin.show.booking',
        'uses' => 'ShowController@booking',
        'middleware' => 'can:admin.show.booking'
    ]);
    Route::get('/result', [
        'as' => 'admin.show.result',
        'uses' => 'ShowController@result',
        'middleware' => 'can:admin.show.result'
    ]);
    Route::get('/result/history', [
        'as' => 'admin.show.history',
        'uses' => 'ShowController@history',
        'middleware' => 'can:admin.show.history'
    ]);
    
    


});