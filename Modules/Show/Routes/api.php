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
        'as' => 'api.show.index',
        'uses' => 'ShowController@index',
        // 'middleware' => 'able:admin.show.index'
    ]);


    Route::post('/save', [
        'as' => 'api.show.store',
        'uses' => 'ShowController@store',
        'middleware' => 'able:admin.show.create'
    ]);
    Route::post('/update_status', [
        'as' => 'api.show.update_status',
        'uses' => 'ShowController@statusUpdate',
        'middleware' => 'able:admin.show.edit'
    ]);
    /*
    Route::post('/delete/{id}', [
        'as' => 'api.show.delete',
        'uses' => 'ShowController@destroy',
        'middleware' => 'able:admin.show.delete'
    ]);
    */
    Route::get('/edit/{id}', [
        'as' => 'api.show.edit',
        'uses' => 'ShowController@edit',
        // 'middleware' => 'able:admin.show.edit'
    ]);

    Route::post('/update', [
        'as' => 'api.show.update',
        'uses' => 'ShowController@update',
        'middleware' => 'able:admin.show.edit'
    ]);

    Route::delete('/delete/{id}', [
        'as' => 'api.show.delete',
        'uses' => 'ShowController@delete',
        'middleware' => 'able:admin.show.delete'
    ]);

    Route::delete('/massDelete', [
        'as' => 'api.show.mass_delete',
        'uses' => 'ShowController@massDelete',
        'middleware' => 'able:admin.show.mass_delete'
    ]);
    
  

});
Route::get('/booking/show_list', [
    'as' => 'api.booking.show_list',
    'uses' => 'ShowController@getBookingShowList',
    'middleware' => 'able:admin.booking.show_list'
]);
