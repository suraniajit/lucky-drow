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
| Here is where you able register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/
Route::prefix('symbole')->group(function() {
    Route::get('/', [
        'as' => 'api.symbole.index',
        'uses' => 'symboleController@index',
        'middleware' => 'able:admin.symbole.index'
    ]);

    Route::post('/filters', [
        'as' => 'api.symbole.filters',
        'uses' => 'symboleController@filters',
        'middleware' => 'able:admin.symbole.filters'
    ]);


    Route::post('/save', [
        'as' => 'api.symbole.store',
        'uses' => 'symboleController@store',
        'middleware' => 'able:admin.symbole.create'
    ]);

    Route::get('/edit/{id}', [
        'as' => 'api.symbole.edit',
        'uses' => 'symboleController@edit',
        'middleware' => 'able:admin.symbole.edit'
    ]);

    Route::post('/update', [
        'as' => 'api.symbole.update',
        'uses' => 'symboleController@update',
        'middleware' => 'able:admin.symbole.edit'
    ]);

    Route::delete('/delete/{id}', [
        'as' => 'api.symbole.delete',
        'uses' => 'symboleController@delete',
        'middleware' => 'able:admin.symbole.delete'
    ]);

    Route::delete('/massDelete', [
        'as' => 'api.symbole.mass_delete',
        'uses' => 'symboleController@massDelete',
        'middleware' => 'able:admin.symbole.mass_delete'
    ]);
    Route::post('/update_status', [
        'as' => 'api.symbole.update_status',
        'uses' => 'symboleController@updateStatus',
        'middleware' => 'able:admin.symbole.edit'
    ]);
});