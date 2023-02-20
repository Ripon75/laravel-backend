<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\frontend\Authcontroller;


Route::post('/login', [Authcontroller::class, 'login']);
Route::post('/register', [Authcontroller::class, 'register']);

Route::middleware(['auth:sanctum'])->group(function () {
    Route::post('/logout', [Authcontroller::class, 'logout']);
});


Route::fallback(function () {
    return 'This route is not define';
});
