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
Route::prefix('show')->group(function() {
    Route::get('/', [
        'as' => 'admin.show.index',
        'uses' => 'ShowController@index',
        'middleware' => 'able:admin.show.index'
    ]);


    Route::post('/save', [
        'as' => 'admin.show.store',
        'uses' => 'showController@store',
        'middleware' => 'able:admin.show.create'
    ]);
    Route::post('/update_status', [
        'as' => 'admin.show.update_status',
        'uses' => 'showController@statusUpdate',
        'middleware' => 'able:admin.show.edit'
    ]);
    Route::post('/delete/{id}', [
        'as' => 'admin.show.delete',
        'uses' => 'showController@destroy',
        'middleware' => 'able:admin.show.delete'
    ]);

    Route::get('/edit/{id}', [
        'as' => 'admin.show.edit',
        'uses' => 'showController@edit',
        'middleware' => 'able:admin.show.edit'
    ]);

    Route::post('/update', [
        'as' => 'admin.show.update',
        'uses' => 'showController@update',
        'middleware' => 'able:admin.show.edit'
    ]);

    Route::delete('/delete/{id}', [
        'as' => 'admin.show.delete',
        'uses' => 'showController@delete',
        'middleware' => 'able:admin.show.delete'
    ]);

    Route::delete('/massDelete', [
        'as' => 'admin.show.mass_delete',
        'uses' => 'showController@massDelete',
        'middleware' => 'able:admin.show.mass_delete'
    ]);
    
  

});
Route::get('/booking/show_list', [
    'as' => 'admin.booking.show_list',
    'uses' => 'showController@getBookingShowList',
    'middleware' => 'able:admin.booking.show_list'
]);
