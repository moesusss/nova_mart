<?php

namespace App\Observers;

use App\Models\OrderItem;

class OrderItemObserver
{
    /**
     * Handle the OrderItem "created" event.
     *
     * @param  \App\Models\OrderItem  $order_item
     * @return void
     */
    public function created(OrderItem $order_item)
    {
        
        $item = $order_item->item;
        if ($item->qty - $order_item->qty == 0) {
            $item->is_instock = false;
        }
        $item->qty -= $order_item->qty;
        $item->save();
        
    }

    /**
     * Handle the OrderItem "updated" event.
     *
     * @param  \App\Models\OrderItem  $order_item
     * @return void
     */
    public function updated(OrderItem $order_item)
    {
        //
    }

    /**
     * Handle the OrderItem "deleted" event.
     *
     * @param  \App\Models\OrderItem  $order_item
     * @return void
     */
    public function deleted(OrderItem $order_item)
    {
        //
    }

    /**
     * Handle the OrderItem "restored" event.
     *
     * @param  \App\Models\OrderItem  $order_item
     * @return void
     */
    public function restored(OrderItem $order_item)
    {
        //
    }

    /**
     * Handle the OrderItem "force deleted" event.
     *
     * @param  \App\Models\OrderItem  $order_item
     * @return void
     */
    public function forceDeleted(OrderItem $order_item)
    {
        //
    }
}
