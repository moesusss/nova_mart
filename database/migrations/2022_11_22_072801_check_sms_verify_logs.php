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
        Schema::create('check_sms_verify_logs', function (Blueprint $table) {
            $table->uuid('id')->primary();
            $table->string('to');
            $table->string('request_id');
            $table->timestamp('sms_created_at');
            $table->timestamp('expired_at');
            $table->timestamps();

        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('check_sms_verify_logs');
    }
};
