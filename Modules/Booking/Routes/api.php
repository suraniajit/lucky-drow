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
        'uses' => 'BookingController@index',
        'middleware' => 'able:admin.booking.index'
    ]);
    Route::post('/save_booking', [
        'as' => 'api.booking.save_booking',
        'uses' => 'BookingController@saveBooking',
        'middleware' => 'able:admin.booking.create'
    ]);
    Route::get('/edit/{id}', [
        'as' => 'api.booking.edit',
        'uses' => 'BookingController@edit',
        'middleware' => 'able:admin.booking.edit'
    ]);
    Route::post('/update', [
        'as' => 'api.booking.update',
        'uses' => 'BookingController@update',
        'middleware' => 'able:admin.booking.edit'
    ]);

    Route::delete('/delete/{id}', [
        'as' => 'api.booking.delete',
        'uses' => 'BookingController@delete',
        'middleware' => 'able:admin.booking.delete'
    ]);

    Route::delete('/massDelete', [
        'as' => 'api.booking.mass_delete',
        'uses' => 'BookingController@massDelete',
        'middleware' => 'able:admin.booking.mass_delete'
    ]);
    
});