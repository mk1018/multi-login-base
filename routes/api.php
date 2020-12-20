<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

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

Route::namespace('App\Http\Controllers')->group( function () {
    Route::apiResource('mail', 'MailController');
});

Route::namespace('App\Http\Controllers\Api')->group( function () {

    // 登録用Api
    Route::post('verify_mail_send', 'User\RegisterController@verifyMailSend');
    Route::post('register', 'User\RegisterController@register');

    // アクセストークン返却用（User）
    Route::namespace('User\Auth')->as('user.auth.')->group( function () {
        Route::post('user/token', 'AuthController@login');
    });

    // アクセストークン返却用（Admin）
    Route::namespace('Admin\Auth')->as('admin.auth.')->group( function () {
        Route::post('admin/token', 'AuthController@login');
    });

    // Userだけ用のapi
    Route::namespace('User')->as('user.')->middleware('auth:api-user')->group( function () {
        // Route::apiResource('register', 'RegisterController');
    });

    // Adminだけ用のapi
    Route::namespace('Admin')->as('admin.')->middleware('auth:api-admin')->group( function () {
    });

    // Userの為だけのAuth用Api
    Route::namespace('User\Auth')->as('user.auth.')->middleware('auth:api-user')->group( function () {
        // Route::post('logout', 'AuthController@logout');
        // Route::post('refresh', 'AuthController@refresh');
        // Route::post('me', 'AuthController@me');
    });

    // Adminの為だけのAuth用Api
    Route::namespace('Admin\Auth')->as('admin.auth.')->middleware('auth:api-admin')->group( function () {
    });

    // 共通api（各々のアクセス制御はコントローラー内のGateで実装）
    Route::middleware('auth:api-user,api-admin')->group( function () {
        Route::apiResource('home', 'HomeController');
        Route::apiResource('user', 'UserController');
        Route::apiResource('admin', 'AdminController');
        Route::apiResource('network', 'NetworkController');
        Route::apiResource('deposit', 'DepositController');
        Route::apiResource('withdrawal', 'WithdrawalController');
        Route::apiResource('payment', 'PaymentController');
        Route::apiResource('payment_type', 'PaymentTypeController');
        Route::apiResource('asset_history', 'AssetHistoryController');
        Route::apiResource('wallet', 'WalletController');
        Route::apiResource('bonus', 'BonusController');
        Route::apiResource('bonus_type', 'BonusTypeController');
        Route::apiResource('chart', 'ChartController');

        // オリジナル
        Route::GET('network/json/{id}', 'NetworkController@networkJson');
        Route::GET('qr_code/{id}', 'UserController@qrCode');
        Route::GET('deposit_user', 'DepositController@indexForUser');
        Route::GET('withdrawal_user', 'WithdrawalController@indexForUser');
        Route::GET('payment_user', 'PaymentController@indexForUser');
        Route::GET('payment_type_enable', 'PaymentTypeController@indexForEnable');
        Route::GET('asset_history_user', 'AssetHistoryController@indexForUser');
        Route::GET('bonus_user', 'BonusController@indexForUser');
        Route::GET('bonus_type_enable', 'BonusTypeController@indexForEnable');
    });

});