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

        if ($sizes) {
            return Helper::response($sizes, 'Sizes list');
        } else {
            return Helper::error(null, 'Sizes not found');
        }
    }
}
