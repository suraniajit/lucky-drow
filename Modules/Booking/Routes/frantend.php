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
/*
Route::prefix('booking')->group(function() {
    Route::get('/', [
        'as' => 'user.booking.index',
        'uses' => 'bookingController@index',
        'middleware' => 'can:user.booking.index'
    ]);

    Route::post('/filters', [
        'as' => 'user.booking.filters',
        'uses' => 'bookingController@filters',
        'middleware' => 'can:user.booking.filters'
    ]);

    Route::get('/create', [
        'as' => 'user.booking.create',
        'uses' => 'bookingController@create',
        'middleware' => 'can:user.booking.create'
    ]);

    Route::post('/', [
        'as' => 'user.booking.store',
        'uses' => 'bookingController@store',
        'middleware' => 'can:user.booking.create'
    ]);

    Route::get('/edit/{id}', [
        'as' => 'user.booking.edit',
        'uses' => 'bookingController@edit',
        'middleware' => 'can:user.booking.edit'
    ]);

    Route::put('/{id}', [
        'as' => 'user.booking.update',
        'uses' => 'bookingController@update',
        'middleware' => 'can:user.booking.edit'
    ]);

    Route::delete('/delete/{id}', [
        'as' => 'user.booking.delete',
        'uses' => 'bookingController@delete',
        'middleware' => 'can:user.booking.delete'
    ]);

    Route::delete('/massDelete', [
        'as' => 'user.booking.mass_delete',
        'uses' => 'bookingController@massDelete',
        'middleware' => 'can:user.booking.mass_delete'
    ]);
    Route::post('/update_status', [
        'as' => 'user.booking.update_status',
        'uses' => 'bookingController@updateStatus',
        'middleware' => 'can:user.booking.edit'
    ]);
});
*/