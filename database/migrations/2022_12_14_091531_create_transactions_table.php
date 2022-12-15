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
        Schema::create('transactions', function (Blueprint $table) {
            $table->uuid('id')->primary();
            $table->string('transaction_ref');
            $table->string('customer_id');
            $table->double('sub_total');
            $table->dateTime('transaction_date');
            $table->string('payment_method');
            $table->string('payment_ref');
            $table->string('payment_status');
            $table->string('customer_address_id');
            $table->boolean('is_coupon')->default(0);
            $table->string('coupon_code')->nullable();
            $table->double('discount_amount')->nullable();
            $table->double('delivery_amount')->default(0);
            $table->string('description')->nullable();
            $table->double('tax_amount')->default(0);
            $table->timestamps();

            $table->foreign('customer_id')->references('id')->on('customers')->onDelete('cascade');
            // $table->foreign('customer_address_id')->references('id')->on('customer_addersses')->onDelete('cascade');

            $table->index([ 
                'id','transaction_ref','transaction_date'
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
        Schema::dropIfExists('transactions');
    }
};
