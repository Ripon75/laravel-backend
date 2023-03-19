<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'address_id',
        'pg_id',
        'current_status_id',
        'current_status_at',
        'delivery_charge',
        'is_paid',
        'paid_at'
    ];

    protected $casts = [
        'user_id'           => 'integer',
        'address_id'        => 'integer',
        'pg_id'             => 'integer',
        'current_status_id' => 'integer',
        'delivery_charge'   => 'decimal:2',
        'is_paid'           => 'boolean',
        'current_status_at' => 'timestamp:Y-m-d H:i:s',
        'paid_at'           => 'timestamp:Y-m-d H:i:s',
        'created_at'        => 'timestamp:Y-m-d H:i:s',
        'updated_at'        => 'timestamp:Y-m-d H:i:s'
    ];

    public function user()
    {
        $this->belongsTo(User::class, 'user_id', 'id');
    }

    public function address()
    {
        $this->belongsTo(Address::class, 'address_id', 'id');
    }

    public function paymentGateway()
    {
        $this->belongsTo(PaymentGateway::class, 'pg_id', 'id');
    }

    public function currentStatus()
    {
        $this->belongsTo(Status::class, 'current_status_id', 'id');
    }

    public function items()
    {
        return $this->belongsToMany(Product::class, 'order_items', 'order_id', 'item_id')
        ->withPivot('size_id', 'color_id', 'quantity', 'price', 'sell_price', 'discount',
        'total_price', 'total_sell_price', 'total_discount')
        ->withTimestamps();
    }

    public function getOrderPrice()
    {
        $OrderPrice = $this->items->sum(function ($item) {
            $itemTotal = $item->pivot->total_price;

            return $itemTotal;
        });

        return $OrderPrice;
    }

    public function getOrderSellPrice()
    {
        $orderSellPrice = $this->items->sum(function($item) {
            return $item->pivot->total_sell_price;
        });
        return $orderSellPrice;
    }

    public function getOrderDiscount()
    {
        $orderDiscount = $this->items->sum(function($item) {
            return $item->pivot->total_discount;
        });

        return $orderDiscount;
    }

    public function orderPayablePrice($round = null)
    {
        $orderSellPrice = $this->getOrderSellPrice();
        $deliveryCharge = $this->delivery_charge;
        $couponValue    = $this->coupon_value;

        $orderPayablePrice = ($orderSellPrice + $deliveryCharge) - $couponValue;
        if ($round === 'round') {
            return round($orderPayablePrice);
        } else {
            return $orderPayablePrice;
        }
    }

    public function updateOrderPrice($orderObj)
    {
        $orderPrice         = $this->getOrderPrice() ?? 0;
        $orderSellPrice     = $this->getOrderSellPrice() ?? 0;
        $orderDiscountPrice = $this->getOrderDiscount() ?? 0;
        $orderPayablePrice  = $this->orderPayablePrice() ?? 0;

        $orderObj->order_price         = $orderPrice;
        $orderObj->order_sell_price    = $orderSellPrice;
        $orderObj->order_discount      = $orderDiscountPrice;
        $orderObj->order_payable_price = $orderPayablePrice;
        $orderObj->save();
    }
}
