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
    
    
});