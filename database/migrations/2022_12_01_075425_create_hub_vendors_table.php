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
        Schema::create('hub_vendors', function (Blueprint $table) {
            $table->uuid('id')->primary();
            $table->uuid('main_service_id');
            $table->string('name');
            $table->string('email')->unique();
            $table->string('mobile')->unique();
            $table->string('address');
            $table->boolean('is_active')->default(0);
            $table->string('password');
            $table->softDeletes();
            $table->rememberToken();
            $table->timestamps();

            $table->foreign('main_service_id')
            ->references('id')->on('main_services')->onDelete('cascade');
            $table->index(['name','mobile', 'id','is_active']);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('hub_vendors');
    }
};
