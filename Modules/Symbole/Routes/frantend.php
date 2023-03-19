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
Route::prefix('symbole')->group(function() {
    Route::get('/', [
        'as' => 'user.symbole.index',
        'uses' => 'symboleController@index',
        'middleware' => 'can:user.symbole.index'
    ]);

    Route::post('/filters', [
        'as' => 'user.symbole.filters',
        'uses' => 'symboleController@filters',
        'middleware' => 'can:user.symbole.filters'
    ]);

    Route::get('/create', [
        'as' => 'user.symbole.create',
        'uses' => 'symboleController@create',
        'middleware' => 'can:user.symbole.create'
    ]);

    Route::post('/', [
        'as' => 'user.symbole.store',
        'uses' => 'symboleController@store',
        'middleware' => 'can:user.symbole.create'
    ]);

    Route::get('/edit/{id}', [
        'as' => 'user.symbole.edit',
        'uses' => 'symboleController@edit',
        'middleware' => 'can:user.symbole.edit'
    ]);

    Route::put('/{id}', [
        'as' => 'user.symbole.update',
        'uses' => 'symboleController@update',
        'middleware' => 'can:user.symbole.edit'
    ]);

    Route::delete('/delete/{id}', [
        'as' => 'user.symbole.delete',
        'uses' => 'symboleController@delete',
        'middleware' => 'can:user.symbole.delete'
    ]);

    Route::delete('/massDelete', [
        'as' => 'user.symbole.mass_delete',
        'uses' => 'symboleController@massDelete',
        'middleware' => 'can:user.symbole.mass_delete'
    ]);
    Route::post('/update_status', [
        'as' => 'user.symbole.update_status',
        'uses' => 'symboleController@updateStatus',
        'middleware' => 'can:user.symbole.edit'
    ]);
});