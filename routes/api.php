<?php

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

Route::post('/order', [\App\Http\Controllers\API\V1\OrderController::class, 'store']);
Route::post('/coupon', [\App\Http\Controllers\API\V1\CouponController::class, 'show']);
Route::get('/store/status', [\App\Http\Controllers\API\V1\StoreStatusController::class, 'show']);
Route::get('/areas', [\App\Http\Controllers\API\V1\AreaController::class, 'index']);
Route::get('/payment-methods', [\App\Http\Controllers\API\V1\PaymentMethodController::class, 'index']);
Route::get('/categories/items', [\App\Http\Controllers\API\V1\CategoryItemController::class, 'index']);
Route::get('/pos/categories/items', [\App\Http\Controllers\API\V1\PosController::class, 'index']);
Route::get('/kiosk/categories/items', [\App\Http\Controllers\API\V1\KioskController::class, 'index']);
Route::get('/exchange-rate', [\App\Http\Controllers\API\V1\PosController::class, 'exchangeRate']);
Route::get('/mobile/categories/items', [\App\Http\Controllers\API\V1\MobileController::class, 'index']);
