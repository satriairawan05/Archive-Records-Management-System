<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('approval_temps', function (Blueprint $table) {
            $table->increments('app_temp_id');
            $table->foreignId('user_id')->nullable();
            $table->foreignId('bid_id')->nullable();
            $table->foreignId('sub_id')->nullable();
            $table->string('app_ordinal')->nullable();
            $table->string('app_created')->nullable();
            $table->string('app_updated')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('approval_temps');
    }
};
