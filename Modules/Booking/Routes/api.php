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
Route::prefix('booking')->group(function() {
    Route::get('/', [
        'as' => 'api.booking.index',
        'uses' => 'bookingController@index',
        'middleware' => 'able:admin.booking.index'
    ]);

    Route::post('/filters', [
        'as' => 'api.booking.filters',
        'uses' => 'bookingController@filters',
        'middleware' => 'able:admin.booking.filters'
    ]);


    Route::post('/save', [
        'as' => 'api.booking.store',
        'uses' => 'bookingController@store',
        'middleware' => 'able:admin.booking.create'
    ]);

    Route::get('/edit/{id}', [
        'as' => 'api.booking.edit',
        'uses' => 'bookingController@edit',
        'middleware' => 'able:admin.booking.edit'
    ]);

    Route::put('/{id}', [
        'as' => 'api.booking.update',
        'uses' => 'bookingController@update',
        'middleware' => 'able:admin.booking.edit'
    ]);

    Route::delete('/delete/{id}', [
        'as' => 'api.booking.delete',
        'uses' => 'bookingController@delete',
        'middleware' => 'able:admin.booking.delete'
    ]);

    Route::delete('/massDelete', [
        'as' => 'api.booking.mass_delete',
        'uses' => 'bookingController@massDelete',
        'middleware' => 'able:admin.booking.mass_delete'
    ]);
    Route::post('/update_status', [
        'as' => 'api.booking.update_status',
        'uses' => 'bookingController@updateStatus',
        'middleware' => 'able:admin.booking.edit'
    ]);
});