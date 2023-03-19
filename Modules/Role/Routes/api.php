<?php
/******************/
//  api route create by SURANI AJIT
//  suraniajit128335@gmail.com
//  9737123443
/******************/

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
Route::prefix('role')->group(function() {
    Route::get('/', [
        'as' => 'api.role.index',
        'uses' => 'RoleController@index',
        'middleware' => 'able:admin.role.index'
    ]);

    Route::post('/store', [
        'as' => 'api.role.store',
        'uses' => 'RoleController@store',
        'middleware' => 'able:admin.role.create'
    ]);

    Route::put('/{id}', [
        'as' => 'api.role.update',
        'uses' => 'RoleController@update',
        'middleware' => 'able:admin.role.edit'
    ]);

    Route::delete('/delete/{id}', [
        'as' => 'api.role.delete',
        'uses' => 'RoleController@delete',
        'middleware' => 'able:admin.role.delete'
    ]);

    Route::delete('/massDelete', [
        'as' => 'api.role.mass_delete',
        'uses' => 'RoleController@massDelete',
        'middleware' => 'able:admin.role.mass_delete'
    ]);
    Route::post('/update_status', [
        'as' => 'api.role.update_status',
        'uses' => 'RoleController@updateStatus',
        'middleware' => 'able:admin.role.edit'
    ]);
});
// for permission
Route::prefix('permission')->group(function() {
    Route::get('/', [
        'as' => 'api.permission.index',
        'uses' => 'PermissonController@index',
        'middleware' => 'able:admin.permission.index'
    ]);
    
    Route::post('/store', [
        'as' => 'api.permission.store',
        'uses' => 'PermissonController@store',
        'middleware' => 'able:admin.permission.create'
    ]);
    Route::delete('/delete/{id}', [
        'as' => 'api.permission.delete',
        'uses' => 'PermissonController@destroy',
        'middleware' => 'able:admin.permission.delete'
    ]);

});


Route::prefix('role-permission')->group(function() {
    Route::get('/{role_name}', [
        'as' => 'api.role-permission.index',
        'uses' => 'RolePermissionController@index',
        'middleware' => 'able:admin.role.permission_change'
    ]);
    Route::get('/{role_name}/{permission}/{flag}', [
        'as' => 'api.role-permission.change',
        'uses' => 'RolePermissionController@changePermissionStatus',
        'middleware' => 'able:admin.role.permission_change'
    ]);
    
});
