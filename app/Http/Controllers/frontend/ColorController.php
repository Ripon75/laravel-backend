<?php

namespace App\Http\Controllers\Frontend;

use App\Utils\Helper;
use App\Models\Color;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class ColorController extends Controller
{
    public function index()
    {
        $colors = Color::withCount(['products'])->get();

        if ($colors) {
            return Helper::response($colors, 'Colors list');
        } else {
            return Helper::error(null, 'Colors not found');
        }
    }
}
