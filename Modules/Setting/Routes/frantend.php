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
Route::prefix('setting')->group(function() {
    Route::get('/', [
        'as' => 'user.setting.index',
        'uses' => 'settingController@index',
        'middleware' => 'can:user.setting.index'
    ]);

    Route::post('/filters', [
        'as' => 'user.setting.filters',
        'uses' => 'settingController@filters',
        'middleware' => 'can:user.setting.filters'
    ]);

    Route::get('/create', [
        'as' => 'user.setting.create',
        'uses' => 'settingController@create',
        'middleware' => 'can:user.setting.create'
    ]);

    Route::post('/', [
        'as' => 'user.setting.store',
        'uses' => 'settingController@store',
        'middleware' => 'can:user.setting.create'
    ]);

    Route::get('/edit/{id}', [
        'as' => 'user.setting.edit',
        'uses' => 'settingController@edit',
        'middleware' => 'can:user.setting.edit'
    ]);

    Route::put('/{id}', [
        'as' => 'user.setting.update',
        'uses' => 'settingController@update',
        'middleware' => 'can:user.setting.edit'
    ]);

    Route::delete('/delete/{id}', [
        'as' => 'user.setting.delete',
        'uses' => 'settingController@delete',
        'middleware' => 'can:user.setting.delete'
    ]);

    Route::delete('/massDelete', [
        'as' => 'user.setting.mass_delete',
        'uses' => 'settingController@massDelete',
        'middleware' => 'can:user.setting.mass_delete'
    ]);
    Route::post('/update_status', [
        'as' => 'user.setting.update_status',
        'uses' => 'settingController@updateStatus',
        'middleware' => 'can:user.setting.edit'
    ]);
});