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
Route::prefix('balance')->group(function() {
    Route::get('/', [
        'as' => 'user.balance.index',
        'uses' => 'balanceController@index',
        'middleware' => 'can:user.balance.index'
    ]);

    Route::post('/filters', [
        'as' => 'user.balance.filters',
        'uses' => 'balanceController@filters',
        'middleware' => 'can:user.balance.filters'
    ]);

    Route::get('/create', [
        'as' => 'user.balance.create',
        'uses' => 'balanceController@create',
        'middleware' => 'can:user.balance.create'
    ]);

    Route::post('/', [
        'as' => 'user.balance.store',
        'uses' => 'balanceController@store',
        'middleware' => 'can:user.balance.create'
    ]);

    Route::get('/edit/{id}', [
        'as' => 'user.balance.edit',
        'uses' => 'balanceController@edit',
        'middleware' => 'can:user.balance.edit'
    ]);

    Route::put('/{id}', [
        'as' => 'user.balance.update',
        'uses' => 'balanceController@update',
        'middleware' => 'can:user.balance.edit'
    ]);

    Route::delete('/delete/{id}', [
        'as' => 'user.balance.delete',
        'uses' => 'balanceController@delete',
        'middleware' => 'can:user.balance.delete'
    ]);

    Route::delete('/massDelete', [
        'as' => 'user.balance.mass_delete',
        'uses' => 'balanceController@massDelete',
        'middleware' => 'can:user.balance.mass_delete'
    ]);
    Route::post('/update_status', [
        'as' => 'user.balance.update_status',
        'uses' => 'balanceController@updateStatus',
        'middleware' => 'can:user.balance.edit'
    ]);
});