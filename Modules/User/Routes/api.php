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

Route::post('/login', [
    'as' => 'api.admin.login',
    'uses' => 'AuthController@checkLogin',
]);

Route::prefix('user')->group(function() {
    Route::get('/', [
        'as' => 'api.user.index',
        'uses' => 'UserController@index',
        'middleware' => 'able:admin.user.index'
    ]);

    Route::post('/filters', [
        'as' => 'api.user.filters',
        'uses' => 'UserController@filters',
        'middleware' => 'able:admin.user.filters'
    ]);


    Route::post('/save', [
        'as' => 'api.user.store',
        'uses' => 'UserController@store',
        'middleware' => 'able:admin.user.create'
    ]);

    Route::get('/edit/{id}', [
        'as' => 'api.user.edit',
        'uses' => 'UserController@edit',
        'middleware' => 'able:admin.user.edit'
    ]);

    Route::post('/update', [
        'as' => 'api.user.update',
        'uses' => 'UserController@update',
        'middleware' => 'able:admin.user.edit'
    ]);

    Route::post('/delete/{id}', [
        'as' => 'api.user.delete',
        'uses' => 'UserController@destroy',
        'middleware' => 'able:admin.user.delete'
    ]);

    Route::post('/massDelete', [
        'as' => 'api.user.mass_delete',
        'uses' => 'UserController@massDelete',
        'middleware' => 'able:admin.user.mass_delete'
    ]);
    Route::post('/update_status', [
        'as' => 'api.user.update_status',
        'uses' => 'UserController@statusUpdate',
        'middleware' => 'able:admin.user.edit'
    ]);
});