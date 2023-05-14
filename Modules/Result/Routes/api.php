<?php
/******************/
//  api route create by SURANI AJIT
//  suraniajit128335@gmail.com
//  9737123443
/******************/

use Illuminate\Http\Request;
/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/
Route::prefix('result')->group(function() {
    Route::get('/', [
        'as' => 'api.result.index',
        'uses' => 'resultController@index',
        'middleware' => 'able:admin.result.index'
    ]);

    Route::post('/filters', [
        'as' => 'api.result.filters',
        'uses' => 'resultController@filters',
        'middleware' => 'able:admin.result.filters'
    ]);


    Route::post('/save', [
        'as' => 'api.result.store',
        'uses' => 'resultController@store',
        'middleware' => 'able:admin.result.create'
    ]);

    Route::get('/edit/{id}', [
        'as' => 'api.result.edit',
        'uses' => 'resultController@edit',
        'middleware' => 'able:admin.result.edit'
    ]);

    Route::put('/{id}', [
        'as' => 'api.result.update',
        'uses' => 'resultController@update',
        'middleware' => 'able:admin.result.edit'
    ]);

    Route::delete('/delete/{id}', [
        'as' => 'api.result.delete',
        'uses' => 'resultController@delete',
        'middleware' => 'able:admin.result.delete'
    ]);

    Route::delete('/massDelete', [
        'as' => 'api.result.mass_delete',
        'uses' => 'resultController@massDelete',
        'middleware' => 'able:admin.result.mass_delete'
    ]);
    Route::post('/update_status', [
        'as' => 'api.result.update_status',
        'uses' => 'resultController@updateStatus',
        'middleware' => 'able:admin.result.edit'
    ]);
});