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
Route::prefix('setting')->group(function() {
    Route::get('/', [
        'as' => 'api.setting.index',
        'uses' => 'settingController@index',
        'middleware' => 'able:admin.setting.index'
    ]);

    Route::post('/filters', [
        'as' => 'api.setting.filters',
        'uses' => 'settingController@filters',
        'middleware' => 'able:admin.setting.filters'
    ]);


    Route::post('/save', [
        'as' => 'api.setting.store',
        'uses' => 'settingController@store',
        'middleware' => 'able:admin.setting.create'
    ]);

    Route::get('/edit/{id}', [
        'as' => 'api.setting.edit',
        'uses' => 'settingController@edit',
        'middleware' => 'able:admin.setting.edit'
    ]);

    Route::put('/{id}', [
        'as' => 'api.setting.update',
        'uses' => 'settingController@update',
        'middleware' => 'able:admin.setting.edit'
    ]);

    Route::delete('/delete/{id}', [
        'as' => 'api.setting.delete',
        'uses' => 'settingController@delete',
        'middleware' => 'able:admin.setting.delete'
    ]);

    Route::delete('/massDelete', [
        'as' => 'api.setting.mass_delete',
        'uses' => 'settingController@massDelete',
        'middleware' => 'able:admin.setting.mass_delete'
    ]);
    Route::post('/update_status', [
        'as' => 'api.setting.update_status',
        'uses' => 'settingController@updateStatus',
        'middleware' => 'able:admin.setting.edit'
    ]);
});