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
Route::prefix('user')->group(function() {
    Route::get('/', [
        'as' => 'api.user.index',
        'uses' => 'userController@index',
        'middleware' => 'can:api.user.index'
    ]);

    Route::post('/filters', [
        'as' => 'api.user.filters',
        'uses' => 'userController@filters',
        'middleware' => 'can:api.user.filters'
    ]);


    Route::post('/save', [
        'as' => 'api.user.store',
        'uses' => 'userController@store',
        'middleware' => 'can:api.user.create'
    ]);

    Route::get('/edit/{id}', [
        'as' => 'api.user.edit',
        'uses' => 'userController@edit',
        'middleware' => 'can:api.user.edit'
    ]);

    Route::put('/{id}', [
        'as' => 'api.user.update',
        'uses' => 'userController@update',
        'middleware' => 'can:api.user.edit'
    ]);

    Route::delete('/delete/{id}', [
        'as' => 'api.user.delete',
        'uses' => 'userController@delete',
        'middleware' => 'can:api.user.delete'
    ]);

    Route::delete('/massDelete', [
        'as' => 'api.user.mass_delete',
        'uses' => 'userController@massDelete',
        'middleware' => 'can:api.user.mass_delete'
    ]);
    Route::post('/update_status', [
        'as' => 'api.user.update_status',
        'uses' => 'userController@updateStatus',
        'middleware' => 'can:api.user.edit'
    ]);
});