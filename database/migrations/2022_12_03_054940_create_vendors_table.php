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
        Schema::create('vendors', function (Blueprint $table) {
            $table->uuid('id')->primary();
            $table->string('name');
            $table->string('mm_name');
            $table->string('email')->unique();
            $table->string('username')->unique();
            $table->string('mobile')->unique()->nullable();
            $table->string('password');
            $table->uuid('main_service_id');
            $table->uuid('hub_vendor_id');
            $table->string('address');
            $table->string('opening_time');
            $table->string('closing_time');
            $table->boolean('is_active')->default(false);
            $table->string('lat');
            $table->string('lng');
            $table->time('min_order_time')->nullable();
            $table->softDeletes();
            $table->rememberToken();
            $table->timestamps();

            $table->foreign('main_service_id')->references('id')->on('main_services')->onDelete('cascade');
            $table->foreign('hub_vendor_id')->references('id')->on('hub_vendors')->onDelete('cascade');
            // $table->dropIndex('geo_state_index');
            $table->index([ 
                'id','name','mm_name',
                'is_active','email'
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
        Schema::disableForeignKeyConstraints();
        Schema::dropIfExists('vendors');
        Schema::enableForeignKeyConstraints();
        	
    }
};