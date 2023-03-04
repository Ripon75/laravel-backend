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
    public function getCartItem()
    {
        $cart = Cart::getCurrentCustomerCart();
        if ($cart) {
            return Helper::response($cart->items, 'Cart information');
        } else {
            return Helper::error(null, 'Product already added to cart');
        }
    }

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
        $totalPrice = 0;
        $price      = $product->price;
        $offerPrice = $product->offer_price;
        if ($offerPrice > 0 && $offerPrice < $price) {
            $discount = $price - $offerPrice;
        }
        $appliedPrice = $offerPrice > 0 ? $offerPrice : $price;
        $totalPrice = $appliedPrice * $quantity;

        // Get customer cart
        $cart = Cart::getCurrentCustomerCart();
        if (count($cart->items)) {
            foreach ($cart->items as $item) {
                if ($item->id == $itemId && $item->pivot->size_id == $sizeId && $item->pivot->color_id == $colorId) {
                    return Helper::error(null, 'Product already added to cart');
                }
            }
        }

        $res = $cart->items()->attach($itemId, [
                'quantity'    => $quantity,
                'price'       => $price,
                'offer_price' => $offerPrice,
                'discount'    => $discount,
                'total_price' => $totalPrice,
                'size_id'     => $sizeId,
                'color_id'    => $colorId
            ]
        );

        return Helper::response($res, 'Product added successfully');
    }

    public function cartItemCount()
    {
        $cartItemCount = 0;
        $cart = Cart::getCurrentCustomerCart();
        if ($cart) {
            $cartItemCount = $cart->items->count() ?? 0;
        }

        return Helper::response($cartItemCount, 'Number of items in cart');
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

        $cart = Cart::getCurrentCustomerCart();
        $res  = $cart->items()->detach($itemId);

        return Helper::response($res, 'Product removed successfuly');
    }
}
