<?php

namespace App\Providers;

use App\Models\OrderItem;
use App\Models\Transaction;
use App\Observers\OrderItemObserver;
use App\Observers\TransactionObserver;
use Illuminate\Support\ServiceProvider;

class ObserverServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
        //
    }

    /**
     * Bootstrap services.
     *
     * @return void
     */
    public function boot()
    {
        Transaction::observe(TransactionObserver::class);
        OrderItem::observe(OrderItemObserver::class);
    }
}
