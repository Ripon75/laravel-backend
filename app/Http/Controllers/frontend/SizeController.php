<?php

namespace App\Http\Controllers\Frontend;

use App\Utils\Helper;
use App\Models\Size;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class SizeController extends Controller
{
    public function index()
    {
        $sizes = Size::withCount(['products'])->get();
        $totalProducts = $sizes->sum('products_count');
        $result = [
            'sizes' => $sizes,
            'total_products'  => $totalProducts,
        ];

        if ($result) {
            return Helper::response($result, 'Sizes list');
        } else {
            return Helper::error(null, 'Sizes not found');
        }
    }
}
