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
Route::prefix('role')->group(function() {
    Route::get('/', [
        'as' => 'user.role.index',
        'uses' => 'RoleController@index',
        'middleware' => 'can:user.role.index'
    ]);

    Route::post('/filters', [
        'as' => 'user.role.filters',
        'uses' => 'RoleController@filters',
        'middleware' => 'can:user.role.filters'
    ]);

    Route::get('/create', [
        'as' => 'user.role.create',
        'uses' => 'RoleController@create',
        'middleware' => 'can:user.role.create'
    ]);

    Route::post('/', [
        'as' => 'user.role.store',
        'uses' => 'RoleController@store',
        'middleware' => 'can:user.role.create'
    ]);

    Route::get('/edit/{id}', [
        'as' => 'user.role.edit',
        'uses' => 'RoleController@edit',
        'middleware' => 'can:user.role.edit'
    ]);

    Route::put('/{id}', [
        'as' => 'user.role.update',
        'uses' => 'RoleController@update',
        'middleware' => 'can:user.role.edit'
    ]);

    Route::delete('/delete/{id}', [
        'as' => 'user.role.delete',
        'uses' => 'RoleController@delete',
        'middleware' => 'can:user.role.delete'
    ]);

    Route::delete('/massDelete', [
        'as' => 'user.role.mass_delete',
        'uses' => 'RoleController@massDelete',
        'middleware' => 'can:user.role.mass_delete'
    ]);
    Route::post('/update_status', [
        'as' => 'user.role.update_status',
        'uses' => 'RoleController@updateStatus',
        'middleware' => 'can:user.role.edit'
    ]);
});