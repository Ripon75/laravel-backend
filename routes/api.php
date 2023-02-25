<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\frontend\Authcontroller;
use App\Http\Controllers\frontend\ProductController;


Route::post('/login', [Authcontroller::class, 'login']);
Route::post('/register', [Authcontroller::class, 'register']);
// Product route
Route::get('/products', [ProductController::class, 'index']);
Route::get('/products/{id}', [ProductController::class, 'show']);

Route::middleware(['auth:sanctum'])->group(function () {
    // Logout route
    Route::post('/logout', [Authcontroller::class, 'logout']);
});


Route::fallback(function () {
    return 'This route is not define';
});
