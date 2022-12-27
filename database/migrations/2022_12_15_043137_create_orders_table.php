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
            $table->uuid('transaction_id');
            $table->string('transaction_ref');
            $table->uuid('vendor_id');
            $table->uuid('customer_id');
            $table->uuid('customer_address_id');
            $table->boolean('is_coupon')->default(0);
            $table->decimal('total_discount_amount', 16, 2)->default(0);
            $table->uuid('delivery_id')->nullable();
            $table->decimal('delivery_amount', 16, 2)->default(0);
            $table->decimal('tax_amount', 16, 2)->default(0);
            $table->decimal('sub_total', 16, 2)->default(0);
            $table->decimal('grand_total', 16, 2)->default(0);
            $table->softDeletes();
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
