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
        'uses' => 'ResultController@index',
        'middleware' => 'can:user.result.index'
    ]);

    Route::post('/filters', [
        'as' => 'user.result.filters',
        'uses' => 'ResultController@filters',
        'middleware' => 'can:user.result.filters'
    ]);

    Route::get('/create', [
        'as' => 'user.result.create',
        'uses' => 'ResultController@create',
        'middleware' => 'can:user.result.create'
    ]);

    Route::post('/', [
        'as' => 'user.result.store',
        'uses' => 'ResultController@store',
        'middleware' => 'can:user.result.create'
    ]);

    Route::get('/edit/{id}', [
        'as' => 'user.result.edit',
        'uses' => 'ResultController@edit',
        'middleware' => 'can:user.result.edit'
    ]);

    Route::put('/{id}', [
        'as' => 'user.result.update',
        'uses' => 'ResultController@update',
        'middleware' => 'can:user.result.edit'
    ]);

    Route::delete('/delete/{id}', [
        'as' => 'user.result.delete',
        'uses' => 'ResultController@delete',
        'middleware' => 'can:user.result.delete'
    ]);

    Route::delete('/massDelete', [
        'as' => 'user.result.mass_delete',
        'uses' => 'ResultController@massDelete',
        'middleware' => 'can:user.result.mass_delete'
    ]);
    Route::post('/update_status', [
        'as' => 'user.result.update_status',
        'uses' => 'ResultController@updateStatus',
        'middleware' => 'can:user.result.edit'
    ]);
});