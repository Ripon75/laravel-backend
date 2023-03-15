<?php

namespace App\Models;

use Illuminate\Support\Facades\Auth;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Cart extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id'
    ];

    protected $casts = [
        'user_id'    => 'integer',
        'created_at' => 'datetime',
        'updated_at' => 'datetime'
    ];

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id', 'id');
    }

    public function sizes()
    {
        return $this->belongsToMany(Size::class, 'cart_items', 'cart_id', 'size_id');
    }

    public function colors()
    {
        return $this->belongsToMany(Color::class, 'cart_items', 'cart_id', 'color_id');
    }

    public function items()
    {
        return $this->belongsToMany(Product::class, 'cart_items', 'cart_id', 'item_id')
        ->withPivot('size_id', 'color_id', 'quantity', 'price', 'sell_price', 'discount',
        'total_price', 'total_sell_price', 'total_discount')
        ->withTimestamps();
    }

    // Get current customer cart
    public static  function getCurrentCustomerCart()
    {
        if (Auth::check()) {
            $authUser = Auth::user();
            $cart     = $authUser->cart;
            if ($cart) {
                return $cart;
            } else {
                $cartObj = new self();
                return $cartObj->createCurrentCustomerCart($authUser->id);
            }
        } else {
            return false;
        }
    }

    // Create current customer cart
    public function createCurrentCustomerCart($userId)
    {
        $cart = new Self;
        $cart->user_id = $userId;
        $cart->save();

        return $cart;
    }


    public function emptyCart()
    {
        $cart = $this->getCurrentCustomerCart();
        $res = $cart->items()->detach();

        return $res;
    }
}
