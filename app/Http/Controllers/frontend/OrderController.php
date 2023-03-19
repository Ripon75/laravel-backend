<?php

namespace App\Http\Controllers\Frontend;

use Carbon\Carbon;
use App\Models\Cart;
use App\Models\Order;
use App\Utils\Helper;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

class OrderController extends Controller
{
    public function store(Request $request)
    {
        $validator = Validator::make($request->All(), [
            'address_id' => ['required', 'integer'],
            'pg_id'      => ['required', 'integer']
        ]);

        if ($validator->stopOnFirstFailure()->fails()) {
            return Helper::error(null, $validator->errors());
        }
        
        $regularDeliveryFee = config('crud.delivery_gateway.regular_fee');
        $promoDeliveryFee   = config('crud.delivery_gateway.promo_fee');
        $addressId          = $request->input('address_id', null);
        $pgId               = $request->input('pg_id', null); // payment gateway id
        $userId             = Auth::id();
        $now                = Carbon::now();
        $deliveryCharge     = $promoDeliveryFee > 0 ? $promoDeliveryFee : $regularDeliveryFee;


        $cart = Cart::getCurrentCustomerCart();

        try {
            DB::beginTransaction();

            $orderObj = new Order();

            $orderObj->user_id = $userId;
            $orderObj->address_id = $addressId;
            $orderObj->pg_id = $pgId;
            $orderObj->current_status_id = 1;
            $orderObj->current_status_at = $now;
            $orderObj->coupon_id = null;
            $orderObj->is_paid = 0;
            $orderObj->paid_at = null;
            $orderObj->coupon_value = 0;
            $orderObj->delivery_charge = $deliveryCharge;
            $res = $orderObj->save();
            if ($res) {
                $itemIds = [];
                foreach ($cart->items as $item) {
                    $itemIds[] = [
                        'item_id'          => $item->id,
                        'size_id'          => $item->pivot->size_id,
                        'color_id'         => $item->pivot->color_id,
                        'quantity'         => $item->pivot->quantity,
                        'price'            => $item->pivot->price,
                        'sell_price'       => $item->pivot->sell_price,
                        'discount'         => $item->pivot->discount,
                        'total_price'      => $item->pivot->total_price,
                        'total_sell_price' => $item->pivot->total_sell_price,
                        'total_discount'   => $item->pivot->total_discount
                    ];
                }
                $orderObj->items()->sync($itemIds);
                $orderObj->updateOrderPrice($orderObj);
                $cart->emptyCart();
                DB::commit();
                return Helper::response($res, 'Order submitted successfully');
            }
        } catch (\Exception $e) {
            DB::rollback();
            info($e);
            return Helper::error(null, 'Something went to wrong');
        }

    }
}
