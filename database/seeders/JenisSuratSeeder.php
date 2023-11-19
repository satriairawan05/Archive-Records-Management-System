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
            'js_jenis' => 'Surat Balasan',
            'js_kode' => 'SB',
            'js_ordinal' => '0',
        ]);

        \App\Models\JenisSurat::create([
            'js_jenis' => 'Surat Teguran',
            'js_kode' => 'ST',
            'js_ordinal' => '0',
        ]);

        \App\Models\JenisSurat::create([
            'js_jenis' => 'Surat Permohonan',
            'js_kode' => 'SPm',
            'js_ordinal' => '0',
        ]);

        \App\Models\JenisSurat::create([
            'js_jenis' => 'Surat Undangan',
            'js_kode' => 'SU',
            'js_ordinal' => '0',
        ]);

        \App\Models\JenisSurat::create([
            'js_jenis' => 'Surat Teknis',
            'js_kode' => 'STe',
            'js_ordinal' => '0',
        ]);
    }
}
