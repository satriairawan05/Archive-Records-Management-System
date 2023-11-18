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
        Schema::create('surat_keluars', function (Blueprint $table) {
            $table->increments('sk_id');
            $table->foreignId('bid_id')->nullable();
            $table->foreignId('sub_id')->nullable();
            $table->string('sk_no_surat')->nullable();
            $table->string('sk_no_surat_old')->nullable();
            $table->date('sk_tgl_surat')->nullable();
            $table->string('sk_disposisi')->nullable();
            $table->string('sk_step')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('surat_keluars');
    }
};
