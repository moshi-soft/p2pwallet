<?php

use App\Http\Controllers\Api\AuthenticationController;
use App\Http\Controllers\Api\PaymentController;
use App\Http\Controllers\Api\ReportController;
use App\Http\Controllers\Api\UserController;
use App\Http\Controllers\Api\WalletController;
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
Route::post('login', [AuthenticationController::class, 'login']);

Route::middleware('auth:sanctum')->group(function () {
    Route::post('logout', [AuthenticationController::class, 'logout']);

    Route::get('payable-user-list', [UserController::class, 'payableUserList']);

    Route::get('wallet', [WalletController::class, 'userWallet']);
    Route::post('pay', [PaymentController::class, 'pay']);
    // report
    Route::get('most-converted-user', [ReportController::class, 'mostConvertedUser']);
    Route::get('total-converted-amount/{user_id?}', [ReportController::class, 'totalConvertedAmount']);
    Route::get('third-highest-transacted-amount/{user_id?}', [ReportController::class, 'thirdHighestTransactedAmount']);
});
