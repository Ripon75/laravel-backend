<?php

namespace App\Http\Controllers\Frontend;

use App\Models\Cart;
use App\Utils\Helper;
use App\Models\Product;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Validator;

class CartController extends Controller
{
    public function addItem(Request $request)
    {
        $validator = Validator::make($request->All(), [
            'item_id'  => ['required', 'integer'],
            'quantity' => ['required', 'integer'],
            'size_id'  => ['required', 'integer'],
            'color_id' => ['required', 'integer']
        ]);

        if ($validator->stopOnFirstFailure()->fails()) {
            return Helper::error(null, $validator->errors());
        }

        $itemId   = $request->input('item_id');
        $quantity = $request->input('quantity');
        $sizeId   = $request->input('size_id');
        $colorId  = $request->input('color_id');

        // Check the item/product is exist in products table
        $product = Product::find($itemId);
        if(!$product) {
            return false;
        }

        $discount   = 0;
        $price      = $product->price;
        $offerPrice = $product->offer_price;
        if ($offerPrice > 0 && $offerPrice < $price) {
            $discount = $price - $offerPrice;
        }

        // Get customer cart
        $cart = new Cart;
        $cart = $cart->getCurrentCustomerCart();
        if (count($cart->items)) {
            foreach ($cart->items as $item) {
                if ($item->id == $itemId && $item->pivot->size_id == $sizeId && $item->pivot->color_id == $colorId) {
                    return Helper::error(null, 'Product already added to cart');
                }
            }
        }

        // $cart->items()->detach($itemId);
        $res = $cart->items()->attach($itemId, [
                'quantity'    => $quantity,
                'price'       => $price,
                'offer_price' => $offerPrice,
                'discount'    => $discount,
                'size_id'     => $sizeId,
                'color_id'    => $colorId
            ]
        );

        return Helper::response($res, 'Item added successfully');
    }

    public function removeItem(Request $request)
    {
        $request->validate([
            'item_id'      => ['required', 'integer'],
        ]);

        $itemId = $request->input('item_id');

        $product = Product::find($itemId);

        if(!$product) {
            return Helper::error(null, 'Product not found');
        }

        $cart = new Cart;

        $cart = $cart->getCurrentCustomerCart();
        $res  = $cart->items()->detach($itemId);

        return Helper::response($res, 'Item removed successfuly');
    }
}
