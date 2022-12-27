<?php

namespace App\Repositories\api\v1\Customer;

use App\Models\City;
use App\Models\Order;
use App\Models\Country;
use App\Repositories\BaseRepository;
use Illuminate\Support\Facades\Hash;
use App\Repositories\api\v1\Customer\OrderItemRepository;

class OrderRepository extends BaseRepository
{
    /**
     * @return string
     */
    public function model()
    {
        return Order::class;
    }


    public function getOrder($id){
        return Order::find($id);
    }

    /**
     * @param array $data
     *
     * @return CustomerAddress
     */
    public function create(array $data) : Order
    {
        $order = Order::create([
            'transaction_id'  => $data['transaction_id'],
            'transaction_ref'  => $data['transaction_ref'],
            'customer_id'  => $data['customer_id'],
            'customer_address_id'  => $data['customer_address_id'],
            'vendor_id'  => $data['vendor_id'],
            'is_coupon'  => isset($data['is_coupon'])? $data['is_coupon']: false,
            'coupon_code'  => isset($data['coupon_code'])? $data['coupon_code']: null,

            
            'total_discount_amount'  => isset($data['total_discount_amount'])? $data['total_discount_amount']: 0,
            'delivery_amount'  => 200,
            'sub_total'  => isset($data['sub_total'])? $data['sub_total']: 0,
            'grand_total'  => isset($data['grand_total'])? $data['grand_total']: 0,
            'tax_amount'  => isset($data['tax_amount'])? $data['tax_amount']: 0,
            
        ]);

        $orderItemRepo = new OrderItemRepository();
        $total_discount_amount = 0;
        $sub_total = 0;

        foreach ($data['order_items'] as $item) {
            $item['order_id'] = $order->id;
            $item['transaction_id'] = $order->transaction_id;
            
            $result = $orderItemRepo->create($item);
            
            $total_discount_amount += $result->discount_amount;
            $sub_total += $result->total;
        }

        $order->total_discount_amount = $total_discount_amount;
        $order->sub_total = $sub_total;
        $order->grand_total = ($sub_total + $order->delivery_amount ) - $total_discount_amount;
        $order->save();

        return $order->refresh();
    }

}
