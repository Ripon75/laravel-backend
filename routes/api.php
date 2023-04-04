<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Frontend\CartController;
use App\Http\Controllers\Frontend\AuthController;
use App\Http\Controllers\Frontend\SizeController;
use App\Http\Controllers\Frontend\OrderController;
use App\Http\Controllers\Frontend\ColorController;
use App\Http\Controllers\Frontend\ProductController;


Route::post('/login',    [AuthController::class, 'login']);
Route::post('/register', [AuthController::class, 'register']);
// Product route
Route::get('/products',      [ProductController::class, 'index']);
Route::get('/products/{id}', [ProductController::class, 'show']);
// Color Route
Route::get('/colors', [ColorController::class, 'index']);
Route::get('/sizes', [SizeController::class, 'index']);

Route::middleware(['auth:sanctum'])->group(function () {
    // All Cart route
    Route::get('/get/cart/items',     [CartController::class, 'getCartItem']);
    Route::post('/add/cart/items',    [CartController::class, 'addItem']);
    Route::post('/cart/items/update', [CartController::class, 'updateCartQty']);
    Route::get('/count/cart/items',   [CartController::class, 'cartItemCount']);
    Route::post('/remove/cart/items', [CartController::class, 'removeItem']);
    Route::get('/empty/cart/items',   [CartController::class, 'emptyCart']);
    // Order route
    Route::post('/orders/submit', [OrderController::class, 'store']);
    // Logout route
    Route::post('/logout', [AuthController::class, 'logout']);
});

Route::fallback(function () {
    return 'This route is not define';
});
