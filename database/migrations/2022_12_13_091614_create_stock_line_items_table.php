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
        Schema::create('stock_line_items', function (Blueprint $table) {
            $table->uuid('id')->primary();
            $table->string('item_id');
            $table->integer('qty');
            $table->double('total');
            $table->string('transaction_id');
            $table->string('vendor_transaction_id');
            $table->boolean('is_promotion')->default(0);
            $table->double('discount_amount');
            $table->longText('description')->nullable();
            $table->timestamps();

            $table->foreign('item_id')->references('id')->on('items')->onDelete('cascade');
            $table->foreign('transaction_id')->references('id')->on('transactions')->onDelete('cascade');
            $table->foreign('vendor_transaction_id')->references('id')->on('vendor_transactions')->onDelete('cascade');

            $table->index([ 
                'id','item_id','transaction_id','vendor_transaction_id'
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
        Schema::dropIfExists('stock_line_items');
    }
};
