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
Route::prefix('show')->group(function() {
    Route::get('/', [
        'as' => 'user.show.index',
        'uses' => 'showController@index',
        'middleware' => 'can:user.show.index'
    ]);

    Route::post('/filters', [
        'as' => 'user.show.filters',
        'uses' => 'showController@filters',
        'middleware' => 'can:user.show.filters'
    ]);

    Route::get('/create', [
        'as' => 'user.show.create',
        'uses' => 'showController@create',
        'middleware' => 'can:user.show.create'
    ]);

    Route::post('/', [
        'as' => 'user.show.store',
        'uses' => 'showController@store',
        'middleware' => 'can:user.show.create'
    ]);

    Route::get('/edit/{id}', [
        'as' => 'user.show.edit',
        'uses' => 'showController@edit',
        'middleware' => 'can:user.show.edit'
    ]);

    Route::put('/{id}', [
        'as' => 'user.show.update',
        'uses' => 'showController@update',
        'middleware' => 'can:user.show.edit'
    ]);

    Route::delete('/delete/{id}', [
        'as' => 'user.show.delete',
        'uses' => 'showController@delete',
        'middleware' => 'can:user.show.delete'
    ]);

    Route::delete('/massDelete', [
        'as' => 'user.show.mass_delete',
        'uses' => 'showController@massDelete',
        'middleware' => 'can:user.show.mass_delete'
    ]);
    Route::post('/update_status', [
        'as' => 'user.show.update_status',
        'uses' => 'showController@updateStatus',
        'middleware' => 'can:user.show.edit'
    ]);
});