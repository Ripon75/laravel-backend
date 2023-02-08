<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\Authcontroller;


Route::middleware('auth:sanctum')->get('/admin', function (Request $request) {
    return $request->user();
});

Route::post('/login', [Authcontroller::class, 'login']);

Route::middleware(['auth:sanctum'])->group(function () {
    Route::post('/register', [Authcontroller::class, 'register']);
    Route::post('/logout', [Authcontroller::class, 'logout']);
});


Route::fallback(function () {
    return 'This route is not define';
});
