<?php

use App\Http\Controllers\Api\AuthenticationController;
use App\Http\Controllers\Api\PaymentController;
use App\Http\Controllers\Api\ReportController;
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
    Route::post('pay', [PaymentController::class, 'pay']);
    // report
    Route::get('most-converted-user', [ReportController::class, 'mostConvertedUser']);
    Route::get('total-converted-amount/{user_id}', [ReportController::class, 'totalConvertedAmount']);
    Route::get('total-converted-amount/{user_id}', [ReportController::class, 'totalConvertedAmount']);
    Route::get('third-highest-transacted-amount/{user_id}', [ReportController::class, 'thirdHighestTransactedAmount']);
});
