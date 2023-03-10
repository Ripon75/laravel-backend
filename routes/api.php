<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\frontend\CartController;
use App\Http\Controllers\frontend\AuthController;
use App\Http\Controllers\frontend\OrderController;
use App\Http\Controllers\frontend\ProductController;


Route::post('/login',    [AuthController::class, 'login']);
Route::post('/register', [AuthController::class, 'register']);
// Product route
Route::get('/products',      [ProductController::class, 'index']);
Route::get('/products/{id}', [ProductController::class, 'show']);

Route::middleware(['auth:sanctum'])->group(function () {
    // All Cart route
    Route::get('/get/cart/items',     [CartController::class, 'getCartItem']);
    Route::post('/add/cart/items',    [CartController::class, 'addItem']);
    Route::post('/cart/items/update', [CartController::class, 'updateCartQty']);
    Route::get('/count/cart/items',   [CartController::class, 'cartItemCount']);
    Route::post('/remove/cart/items', [CartController::class, 'removeItem']);
    Route::get('/empty/cart/items',   [CartController::class, 'emptyCart']);
    // Order route
    Route::post('/orders', [OrderController::class, 'store']);
    // Logout route
    Route::post('/logout', [AuthController::class, 'logout']);
});


Route::fallback(function () {
    return 'This route is not define';
});
