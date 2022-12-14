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
            $table->string('mm_name')->nullable();
            $table->string('email')->unique()->nullable();
            $table->string('username')->unique()->nullable();
            $table->string('mobile')->unique();
            $table->string('password')->nullable();
            $table->uuid('main_service_id');
            $table->uuid('hub_vendor_id');
            $table->string('address');
            $table->string('opening_time');
            $table->string('order_closing_time');
            $table->string('closing_time');
            $table->boolean('is_active')->default(false);
            $table->boolean('is_closed')->default(false);
            $table->string('cover_image')->nullable();
            $table->longText('sub_categories_id')->nullable();
            $table->string('commission_fee')->nullable();
            $table->string('lat');
            $table->string('lng');
            $table->integer('min_order_time')->default(0);
            $table->integer('min_order_amount')->default(0);
            $table->uuid('created_by')->nullable();
            $table->uuid('updated_by')->nullable();
            $table->uuid('deleted_by')->nullable();
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