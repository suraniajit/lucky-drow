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
Route::prefix('symbole')->group(function() {
    Route::get('/', [
        'as' => 'api.symbole.index',
        'uses' => 'symboleController@index',
        'middleware' => 'can:api.symbole.index'
    ]);

    Route::post('/filters', [
        'as' => 'api.symbole.filters',
        'uses' => 'symboleController@filters',
        'middleware' => 'can:api.symbole.filters'
    ]);


    Route::post('/save', [
        'as' => 'api.symbole.store',
        'uses' => 'symboleController@store',
        'middleware' => 'can:api.symbole.create'
    ]);

    Route::get('/edit/{id}', [
        'as' => 'api.symbole.edit',
        'uses' => 'symboleController@edit',
        'middleware' => 'can:api.symbole.edit'
    ]);

    Route::put('/{id}', [
        'as' => 'api.symbole.update',
        'uses' => 'symboleController@update',
        'middleware' => 'can:api.symbole.edit'
    ]);

    Route::delete('/delete/{id}', [
        'as' => 'api.symbole.delete',
        'uses' => 'symboleController@delete',
        'middleware' => 'can:api.symbole.delete'
    ]);

    Route::delete('/massDelete', [
        'as' => 'api.symbole.mass_delete',
        'uses' => 'symboleController@massDelete',
        'middleware' => 'can:api.symbole.mass_delete'
    ]);
    Route::post('/update_status', [
        'as' => 'api.symbole.update_status',
        'uses' => 'symboleController@updateStatus',
        'middleware' => 'can:api.symbole.edit'
    ]);
});