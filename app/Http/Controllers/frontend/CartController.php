<?php

namespace App\Http\Controllers\Frontend;

use Auth;
use App\Models\Cart;
use App\Utils\Helper;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Validator;

class CartController extends Controller
{
    public function getCartItem()
    {
        $cart = Cart::with(['items:id,name,img_src', 'sizes:id,name', 'colors:id,name'])->where('user_id', Auth::id())->first();
        if ($cart) {
            return Helper::response($cart, 'Cart information');
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

        $totalPrice   = 0;
        $price        = $product->price;
        $offerPrice   = $product->offer_price;
        $sellingPrice = $offerPrice > 0 ? $offerPrice : $price;
        $totalPrice   = $sellingPrice * $quantity;

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
                'quantity'      => $quantity,
                'selling_price' => $sellingPrice,
                'total_price'   => $totalPrice,
                'size_id'       => $sizeId,
                'color_id'      => $colorId
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

    public function updateCartQty(Request $request)
    {
        $validator = Validator::make($request->All(), [
            'item_id'       => ['required', 'integer'],
            'size_id'       => ['required', 'integer'],
            'color_id'      => ['required', 'integer'],
            'quantity'      => ['required', 'integer'],
            'selling_price' => ['required']
        ]);

        if ($validator->stopOnFirstFailure()->fails()) {
            return Helper::error(null, $validator->errors());
        }

        $itemId       = $request->input('item_id', null);
        $sizeId       = $request->input('size_id', null);
        $colorId      = $request->input('color_id', null);
        $quantity     = $request->input('quantity', null);
        $sellingPrice = $request->input('selling_price', null);
        $totalPrice   = $sellingPrice * $quantity;

        $res = DB::table('cart_items')->where('item_id', $itemId)->where('size_id', $sizeId)
        ->where('color_id', $colorId)->update(['quantity' => $quantity, 'total_price' => $totalPrice]);

        if ($res) {
            return Helper::response($res, 'Quantity updated successfuly');
        } else {
            return Helper::error(null, 'Something went to wrong');
        }
    }

    public function removeItem(Request $request)
    {
       $validator = Validator::make($request->All(), [
            'item_id'  => ['required', 'integer'],
            'size_id'  => ['required', 'integer'],
            'color_id' => ['required', 'integer']
        ]);

        if ($validator->stopOnFirstFailure()->fails()) {
            return Helper::error(null, $validator->errors());
        }

        $itemId   = $request->input('item_id', null);
        $sizeId   = $request->input('size_id', null);
        $colorId  = $request->input('color_id', null);

        $res = DB::table('cart_items')->where('item_id', $itemId)->where('size_id', $sizeId)
        ->where('color_id', $colorId)->delete();

        if ($res) {
            return Helper::response($res, 'Item removed successfuly');
        } else {
            return Helper::error(null, 'Something went to wrong');
        }
    }
}
