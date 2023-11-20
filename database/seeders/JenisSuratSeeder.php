<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class JenisSuratSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        \App\Models\JenisSurat::create([
            'js_jenis' => 'Surat Keterangan',
        ]);

        \App\Models\JenisSurat::create([
            'js_jenis' => 'Surat Balasan',
        ]);

        \App\Models\JenisSurat::create([
            'js_jenis' => 'Surat Undangan',
        ]);

        \App\Models\JenisSurat::create([
            'js_jenis' => 'Pengumuman',
        ]);

        \App\Models\JenisSurat::create([
            'js_jenis' => 'Surat Edaran',
        ]);

        \App\Models\JenisSurat::create([
            'js_jenis' => 'Surat Kuasa',
        ]);

        \App\Models\JenisSurat::create([
            'js_jenis' => 'Surat Perintah Tugas',
        ]);

        \App\Models\JenisSurat::create([
            'js_jenis' => 'Surat Pengantar',
        ]);

        \App\Models\JenisSurat::create([
            'js_jenis' => 'Surat Permohonan Izin',
        ]);

        \App\Models\JenisSurat::create([
            'js_jenis' => 'Surat Keputusan',
        ]);

        \App\Models\JenisSurat::create([
            'js_jenis' => 'Notulen Rapat',
        ]);

        \App\Models\JenisSurat::create([
            'js_jenis' => 'Berita Acara',
        ]);

        \App\Models\JenisSurat::create([
            'js_jenis' => 'Surat Perjanjian',
        ]);

        \App\Models\JenisSurat::create([
            'js_jenis' => 'Saran Teknis',
        ]);
    }
}
