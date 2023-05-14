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
Route::prefix('balance')->group(function() {

    Route::get('/current_balance', [
        'as' => 'api.balance.current_balance',
        'uses' => 'BalanceController@getCurrentBalance',
        'middleware' => 'able:admin.balance.current_balance'
    ]);
    
    Route::get('/', [
        'as' => 'api.balance.index',
        'uses' => 'BalanceController@index',
        'middleware' => 'able:admin.balance.index'
    ]);

    // Route::post('/filters', [
    //     'as' => 'api.balance.filters',
    //     'uses' => 'BalanceController@filters',
    //     'middleware' => 'able:admin.balance.filters'
    // ]);
    Route::post('/deposit_request', [
        'as' => 'api.balance.deposit_request',
        'uses' => 'BalanceController@depositRequest',
        'middleware' => 'able:admin.balance.deposit_request'
    ]);
    Route::post('/deposit_otp_varify', [
        'as' => 'api.balance.deposit_otp_varify',
        'uses' => 'BalanceController@depositOTPVarify',
        'middleware' => 'able:admin.balance.deposit_otp_varify'
    ]);
    Route::post('/withdrawal_request', [
        'as' => 'api.balance.withdrawal_request',
        'uses' => 'BalanceController@withdrawalRequest',
        'middleware' => 'able:admin.balance.withdrawal_request'
    ]);
    Route::post('/withdrawal_otp_varify', [
        'as' => 'api.balance.withdrawal_otp_varify',
        'uses' => 'BalanceController@withdrawalOTPVarify',
        'middleware' => 'able:admin.balance.withdrawal_otp_varify'
    ]);
    Route::get('/transaction/{user_id}', [
        'as' => 'api.balance.transaction',
        'uses' => 'BalanceTransactionController@index',
        'middleware' => 'able:admin.balance-transaction.all-users'
    ]);
    // own transaction
    // Route::get('/transaction/{user_id}', [
    //     'as' => 'api.balance.transaction',
    //     'uses' => 'BalanceTransactionController@index',
    //     'middleware' => 'able:admin.balance-transaction.all-user'
    // ]);
    
    

   
});