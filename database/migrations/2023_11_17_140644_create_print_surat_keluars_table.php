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
        Schema::create('print_surat_keluars', function (Blueprint $table) {
            $table->increments('ps_id');
            $table->foreignId('sk_id')->nullable()->references('sk_id')->on('surat_keluars')->constrained()->cascadeOnUpdate()->cascadeOnDelete();
            $table->integer('ps_count')->default(0)->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('print_surat_keluars');
    }
};
