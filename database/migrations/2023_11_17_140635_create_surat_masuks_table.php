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
        Schema::create('surat_masuks', function (Blueprint $table) {
            $table->increments('sm_id');
            $table->string('sm_jenis')->nullable();
            $table->foreignId('bid_id')->nullable()->references('bid_id')->on('bidangs')->constrained()->cascadeOnUpdate()->cascadeOnDelete();
            $table->foreignId('sub_id')->nullable()->references('sub_id')->on('sub_bidangs')->constrained()->cascadeOnUpdate()->cascadeOnDelete();
            $table->string('sm_asal')->nullable();
            $table->string('sm_no_surat')->nullable();
            $table->date('sm_tgl_surat')->nullable();
            $table->date('sm_tgl_diterima')->nullable();
            $table->string('sm_pengirim')->nullable();
            $table->string('sm_penerima')->nullable();
            $table->string('sm_perihal')->nullable();
            // $table->string('sm_halaman')->nullable();
            $table->string('sm_file')->nullable();
            $table->string('sm_created')->nullable();
            $table->string('sm_updated')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('surat_masuks');
    }
};
