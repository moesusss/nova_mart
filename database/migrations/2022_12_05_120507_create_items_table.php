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
        Schema::create('items', function (Blueprint $table) {
            $table->uuid('id')->primary();
            $table->string('name');
            $table->string('mm_name')->nullable();
            $table->uuid('vendor_id');
            $table->uuid('category_id');
            $table->uuid('sub_category_id');
            $table->uuid('brand_id')->nullable();
            $table->string('sku')->unique();
            $table->string('barcode')->unique()->nullable();
            $table->integer('qty');
            $table->integer('maximum_order_count')->default(10);
            $table->decimal('price', 16, 2)->default(2);
            $table->decimal('weight', 16, 2)->default(2);
            $table->boolean('is_active')->default(false);
            $table->boolean('is_instock')->default(false);
            $table->boolean('is_package')->default(false);
            $table->boolean('is_tax')->default(false);
            $table->longText('description');
            $table->string('item_type');
            $table->string('unit_type');
            $table->uuid('created_by_id')->nullable();
            $table->uuid('updated_by_id')->nullable();
            $table->uuid('deleted_by_id')->nullable();
            $table->uuid('created_by_type')->nullable();
            $table->uuid('updated_by_type')->nullable();
            $table->uuid('deleted_by_type')->nullable();
            $table->softDeletes();
            $table->rememberToken();
            $table->timestamps();

            $table->foreign('vendor_id')->references('id')->on('vendors')->onDelete('cascade');
            $table->foreign('category_id')->references('id')->on('categories')->onDelete('cascade');
            $table->foreign('sub_category_id')->references('id')->on('sub_categories')->onDelete('cascade');

            $table->index([ 
                'id','name','mm_name','is_active'
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
        Schema::dropIfExists('items');
    }
};








