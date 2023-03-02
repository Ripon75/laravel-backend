<?php

namespace App\Http\Controllers\Frontend;

use App\Utils\Helper;
use App\Models\Product;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class ProductController extends Controller
{
    public function index(Request $request)
    {
        $paginate = config('crud.paginate.default');

        $products = new Product();

        $products = $products->paginate($paginate);

        if ($products) {
            return Helper::response($products, 'Products list');
        } else {
            return Helper::error(null, 'Product not found');
        }
    }

    public function show($id)
    {
        $product = Product::with(['category:id,name', 'images', 'sizes:id,name,slug', 'colors'])->find($id);

        if ($product) {
            return Helper::response($product, 'Product single view');
        } else {
            return Helper::error(null, 'Product not found');
        }
    }
}
