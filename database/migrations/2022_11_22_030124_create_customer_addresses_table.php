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
        Schema::create('customer_addresses', function (Blueprint $table) {
            $table->uuid('id')->primary();
            $table->uuid('customer_id');
            $table->uuid('city_id');
            $table->string('city_name');
            $table->uuid('country_id');
            $table->string('country_name');
            $table->string('address');
            $table->string('lat');
            $table->string('lng');
            $table->text('delivery_instructions')->nullable();
            $table->boolean('is_delivery_available')->default(1);
            $table->softDeletes();
            $table->timestamps();

            $table->index(['city_name', 'country_name']);

            $table->foreign('customer_id')
            ->references('id')->on('customers')->onDelete('cascade');
            $table->foreign('city_id')
            ->references('id')->on('cities')->onDelete('cascade');
            $table->foreign('country_id')
            ->references('id')->on('countries')->onDelete('cascade');

            
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('customer_addresses');
    }
};
