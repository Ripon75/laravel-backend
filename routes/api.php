<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\frontend\CartController;
use App\Http\Controllers\frontend\AuthController;
use App\Http\Controllers\frontend\ProductController;


Route::post('/login', [AuthController::class, 'login']);
Route::post('/register', [AuthController::class, 'register']);
// Product route
Route::get('/products', [ProductController::class, 'index']);
Route::get('/products/{id}', [ProductController::class, 'show']);

Route::middleware(['auth:sanctum'])->group(function () {
    // All Cart route
    // Route::get('/checkout',                   [PageController::class, 'checkout'])->name('checkout');
    Route::post('/cart/item/add',             [CartController::class, 'addItem'])->name('cart.item.add');
    // Route::post('/cart/item/remove',          [CartController::class, 'removeItem'])->name('cart.item.remove');
    // Route::get('/cart/empty',                 [CartController::class, 'emptyCart']);
    // Route::post('/cart/shipping/address/add', [CartController::class, 'addShippingAdress']);
    // Logout route
    Route::post('/logout', [AuthController::class, 'logout']);
});


Route::fallback(function () {
    return 'This route is not define';
});
