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
        'as' => 'api.setting.getSetting',
        'uses' => 'SettingController@getSetting',
        'middleware' => 'able:admin.setting.getSetting'
    ]);
    
    Route::post('/update', [
        'as' => 'api.setting.update',
        'uses' => 'SettingController@update',
        'middleware' => 'able:admin.setting.update'
    ]);

});