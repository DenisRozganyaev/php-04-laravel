<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});


Route::middleware('auth:sanctum')->group(function() {
//    Route::prefix('paypal')->name('paypal.')->group(function() {
//        Route::post('order/create', [\App\Http\Controllers\Api\Payments\PaypalController::class, 'create'])->name('orders.create');
//        Route::post('order/{orderId}/capture', [\App\Http\Controllers\Api\Payments\PaypalController::class, 'capture'])->name('orders.capture');
//    });
});
