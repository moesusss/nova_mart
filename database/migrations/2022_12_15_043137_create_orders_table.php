<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('orders', function (Blueprint $table) {
            $table->uuid('id')->primary();
            $table->string('transaction_id');
            $table->string('transaction_ref');
            $table->string('customer_id');
            $table->string('customer_address_id');
            $table->double('sub_total');
            $table->boolean('is_coupon')->default(0);
            $table->double('discount_amount')->default(0);
            $table->string('delivery_id');
            $table->string('delivery_charges');
            $table->double('tax_amount')->default(0);
            $table->timestamps();

            $table->foreign('customer_id')->references('id')->on('customers')->onDelete('cascade');
            $table->foreign('transaction_id')->references('id')->on('transactions')->onDelete('cascade');
            // $table->foreign('customer_address_id')->references('id')->on('customer_addersses')->onDelete('cascade');

            $table->index([ 
                'id','transaction_id','customer_id','delivery_id'
            ]);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('orders');
    }
};
