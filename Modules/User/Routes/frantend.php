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
Route::prefix('user')->group(function() {
    Route::get('/', [
        'as' => 'user.user.index',
        'uses' => 'UserController@index',
        'middleware' => 'can:user.user.index'
    ]);

    Route::post('/filters', [
        'as' => 'user.user.filters',
        'uses' => 'UserController@filters',
        'middleware' => 'can:user.user.filters'
    ]);

    Route::get('/create', [
        'as' => 'user.user.create',
        'uses' => 'UserController@create',
        'middleware' => 'can:user.user.create'
    ]);

    Route::post('/', [
        'as' => 'user.user.store',
        'uses' => 'UserController@store',
        'middleware' => 'can:user.user.create'
    ]);

    Route::get('/edit/{id}', [
        'as' => 'user.user.edit',
        'uses' => 'UserController@edit',
        'middleware' => 'can:user.user.edit'
    ]);

    Route::put('/{id}', [
        'as' => 'user.user.update',
        'uses' => 'UserController@update',
        'middleware' => 'can:user.user.edit'
    ]);

    Route::delete('/delete/{id}', [
        'as' => 'user.user.delete',
        'uses' => 'UserController@delete',
        'middleware' => 'can:user.user.delete'
    ]);

    Route::delete('/massDelete', [
        'as' => 'user.user.mass_delete',
        'uses' => 'UserController@massDelete',
        'middleware' => 'can:user.user.mass_delete'
    ]);
    Route::post('/update_status', [
        'as' => 'user.user.update_status',
        'uses' => 'UserController@updateStatus',
        'middleware' => 'can:user.user.edit'
    ]);
});