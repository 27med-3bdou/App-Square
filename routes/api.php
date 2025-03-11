<?php

use App\Http\Controllers\Api\App\AreaController;
use App\Http\Controllers\Api\App\CartController;
use App\Http\Controllers\Api\App\CheckoutController;
use App\Http\Controllers\Api\App\LocationController;
use App\Http\Controllers\Api\App\ProductController;
use App\Http\Controllers\Api\App\ZoneController;
use App\Http\Controllers\Api\Auth\AuthController;
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
Route::middleware('auth:sanctum')->group(function () {

    Route::prefix('auth')->group(function () {
        Route::get('/index', [AuthController::class, 'index']);
        Route::post('/register', [AuthController::class, 'register']);
        Route::post('/login', [AuthController::class, 'login']);
        Route::post('/logout', [AuthController::class, 'logout']);
        Route::post('send-otp', [AuthController::class, 'sendOTP']);
        Route::post('reset-password', [AuthController::class, 'resetPassword']);
    });

    Route::prefix('product')->group(function () {
        Route::get('/all', [ProductController::class, 'index']);
        Route::post('/store', [ProductController::class, 'store']);
        Route::get('/of-categore', [ProductController::class, 'productOFcategore']);
    });

    Route::prefix('zone')->group(function () {
        Route::get('/all', [ZoneController::class, 'index']);
        Route::post('/store', [ZoneController::class, 'store']);
        Route::post('/{id}', [ZoneController::class, 'show']);
    });

    Route::prefix('area')->group(function () {
        Route::get('/all', [AreaController::class, 'index']);
        Route::post('/store', [AreaController::class, 'store']);
    });

    Route::post('/store-location', [LocationController::class, 'store']);

    Route::prefix('cart')->group(function () {
        Route::get('/', [CartController::class, 'viewCart']);
        Route::post('/add', [CartController::class, 'addToCart']);
        Route::delete('/item/{id}', [CartController::class, 'removeFromCart']);
        Route::delete('/clear', [CartController::class, 'clearCart']);
    });

    Route::post('/checkout', [CheckoutController::class, 'checkout']);
});
