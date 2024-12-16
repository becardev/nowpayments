<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::create('payment_settings', function (Blueprint $table) {
            $table->id();
            $table->string('sandbox_api_key')->nullable();
            $table->string('live_api_key')->nullable();
            $table->boolean('sandbox_mode')->default(true);
            $table->string('default_currency')->default('USD');
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('payment_settings');
    }
};
