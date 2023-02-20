<?php

use Illuminate\Support\Facades\Route;


Route::fallback(function () {
    return 'This route is not define';
});
