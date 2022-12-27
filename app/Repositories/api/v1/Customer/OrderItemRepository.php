<?php

namespace App\Repositories\api\v1\Customer;

use App\Models\OrderItem;
use App\Repositories\BaseRepository;

class OrderItemRepository extends BaseRepository
{
    /**
     * @return string
     */
    public function model()
    {
        return OrderItem::class;
    }


    public function getOrderItem($id){
        return OrderItem::find($id);
    }

    /**
     * @param array $data
     *
     * @return OrderItem
     */
    public function create(array $data) : OrderItem
    {
        $order_item = OrderItem::create([
            'order_id'  => $data['order_id'],
            'transaction_id'  => $data['transaction_id'],
            'item_id'  => $data['item_id'],
            'qty'  => $data['qty'],
            'price'  => $data['price'],
            'total'  => $data['qty'] * $data['price'],
            'is_promotion'  => isset($data['is_promotion'])? $data['is_promotion']: false,
            'discount_amount'  => isset($data['discount_amount'])? $data['discount_amount']: 0,
            'description'  => isset($data['description'])? $data['description']: 0,
            
        ]);
        return $order_item->refresh();
    }

}
