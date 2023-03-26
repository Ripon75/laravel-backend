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
        $totalProducts = $colors->sum('products_count');
        $result = [
            'colors' => $colors,
            'total_products'  => $totalProducts,
        ];

        if ($result) {
            return Helper::response($result, 'Colors list');
        } else {
            return Helper::error(null, 'Colors not found');
        }
    }
}
