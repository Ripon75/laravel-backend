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
        $limit                 = $request->input('limit', null);
        $pagination            = $request->input('pagination', false);
        $paginationSize        = $request->input('pagination_size', null);
        $selectedColorIds      = $request->input('selected_color_ids', []);
        $selectedSizeIds       = $request->input('selected_size_ids', []);
        $defaultPaginationSize = config('crud.paginate.default');

        $paginationSize = $paginationSize ? $paginationSize: $defaultPaginationSize;

        $pagination = true;

        $products = new Product();
        
        if ($selectedColorIds) {
            $products = $products->whereHas('colors', function($query) use ($selectedColorIds) {
                $query->whereIn('color_id', [$selectedColorIds]);
            });
        }

        // if ($selectedSizeIds) {
        //     $products = $products->whereHas('sizes', function($query) use ($selectedSizeIds) {
        //         $query->whereIn('size_id', $selectedSizeIds);
        //     });
        // }

        if ($limit) {
            $products = $products->take($limit)->latest()->get();
        } elseif($pagination) {
            $products = $products->paginate(3);
            // $products->appends(request()->all())->links();
        } else {
            $products = $products->get();
        }

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
