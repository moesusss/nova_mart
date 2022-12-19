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
            $table->string('transaction_ref')->unique()->nullable();
            $table->uuid('customer_id')->index();
            $table->uuid('customer_address_id')->index();
            $table->boolean('is_coupon')->default(false);
            $table->string('coupon_code')->nullable();
            $table->decimal('total_discount_amount', 16, 2)->default(0);
            $table->decimal('total_delivery_amount', 16, 2)->default(0);
            $table->decimal('sub_total', 16, 2)->default(0);
            $table->decimal('grand_total', 16, 2)->default(0);
            $table->dateTime('transaction_date');
            $table->uuid('payment_method_id')->index();
            $table->string('payment_ref')->nullable();
            $table->string('payment_status')->nullable();
            $table->text('description')->nullable();
            $table->decimal('tax_amount', 16, 2)->default(0);
            $table->softDeletes();
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
