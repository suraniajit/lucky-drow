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
Route::prefix('result')->group(function() {
    Route::get('/', [
        'as' => 'user.result.index',
        'uses' => 'resultController@index',
        'middleware' => 'can:user.result.index'
    ]);

    Route::post('/filters', [
        'as' => 'user.result.filters',
        'uses' => 'resultController@filters',
        'middleware' => 'can:user.result.filters'
    ]);

    Route::get('/create', [
        'as' => 'user.result.create',
        'uses' => 'resultController@create',
        'middleware' => 'can:user.result.create'
    ]);

    Route::post('/', [
        'as' => 'user.result.store',
        'uses' => 'resultController@store',
        'middleware' => 'can:user.result.create'
    ]);

    Route::get('/edit/{id}', [
        'as' => 'user.result.edit',
        'uses' => 'resultController@edit',
        'middleware' => 'can:user.result.edit'
    ]);

    Route::put('/{id}', [
        'as' => 'user.result.update',
        'uses' => 'resultController@update',
        'middleware' => 'can:user.result.edit'
    ]);

    Route::delete('/delete/{id}', [
        'as' => 'user.result.delete',
        'uses' => 'resultController@delete',
        'middleware' => 'can:user.result.delete'
    ]);

    Route::delete('/massDelete', [
        'as' => 'user.result.mass_delete',
        'uses' => 'resultController@massDelete',
        'middleware' => 'can:user.result.mass_delete'
    ]);
    Route::post('/update_status', [
        'as' => 'user.result.update_status',
        'uses' => 'resultController@updateStatus',
        'middleware' => 'can:user.result.edit'
    ]);
});