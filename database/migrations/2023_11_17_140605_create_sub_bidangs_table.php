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
        Schema::create('sub_bidangs', function (Blueprint $table) {
            $table->increments('sub_id');
            $table->foreignId('bid_id')->nullable()->references('bid_id')->on('bidangs')->constrained()->cascadeOnUpdate()->cascadeOnDelete();
            $table->string('sub_name')->nullable();
            $table->string('sub_alias')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('sub_bidangs');
    }
};
