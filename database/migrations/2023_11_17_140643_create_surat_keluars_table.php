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
            $table->foreignId('js_id')->nullable();
            $table->foreignId('bid_id')->nullable();
            $table->foreignId('sub_id')->nullable();
            $table->string('sk_asal')->nullable();
            $table->string('sk_tujuan')->nullable();
            $table->string('sk_no')->nullable();
            $table->string('sk_no_old')->nullable();
            $table->string('sk_sifat')->nullable();
            $table->string('sk_perihal')->nullable();
            $table->longText('sk_deskripsi')->nullable();
            $table->date('sk_tgl')->nullable();
            $table->date('sk_tgl_old')->nullable();
            $table->string('sk_remark')->nullable();
            $table->string('sk_step')->nullable();
            $table->string('sk_print')->default('0')->nullable();
            $table->string('sk_created')->nullable();
            $table->string('sk_updated')->nullable();
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
