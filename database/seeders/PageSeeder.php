<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class PageSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Surat Masuk
        \App\Models\Page::create([
            'page_name' => 'Surat Masuk',
            'action' => 'Create',
        ]);

        \App\Models\Page::create([
            'page_name' => 'Surat Masuk',
            'action' => 'Read',
        ]);

        \App\Models\Page::create([
            'page_name' => 'Surat Masuk',
            'action' => 'Update',
        ]);

        \App\Models\Page::create([
            'page_name' => 'Surat Masuk',
            'action' => 'Delete',
        ]);

        // Surat Keluar
        \App\Models\Page::create([
            'page_name' => 'Surat Keluar',
            'action' => 'Create',
        ]);

        \App\Models\Page::create([
            'page_name' => 'Surat Keluar',
            'action' => 'Read',
        ]);

        \App\Models\Page::create([
            'page_name' => 'Surat Keluar',
            'action' => 'Approval',
        ]);

        \App\Models\Page::create([
            'page_name' => 'Surat Keluar',
            'action' => 'Update',
        ]);

        \App\Models\Page::create([
            'page_name' => 'Surat Keluar',
            'action' => 'Delete',
        ]);

        \App\Models\Page::create([
            'page_name' => 'Surat Keluar',
            'action' => 'Close',
        ]);

        // Archive
        \App\Models\Page::create([
            'page_name' => 'Archive',
            'action' => 'Read',
        ]);

        // Jenis Surat
        \App\Models\Page::create([
            'page_name' => 'Jenis Surat',
            'action' => 'Create',
        ]);

        \App\Models\Page::create([
            'page_name' => 'Jenis Surat',
            'action' => 'Read',
        ]);

        \App\Models\Page::create([
            'page_name' => 'Jenis Surat',
            'action' => 'Update',
        ]);

        \App\Models\Page::create([
            'page_name' => 'Jenis Surat',
            'action' => 'Delete',
        ]);

        // Perusahaan
        \App\Models\Page::create([
            'page_name' => 'Perusahaan',
            'action' => 'Create',
        ]);

        \App\Models\Page::create([
            'page_name' => 'Perusahaan',
            'action' => 'Read',
        ]);

        \App\Models\Page::create([
            'page_name' => 'Perusahaan',
            'action' => 'Update',
        ]);

        \App\Models\Page::create([
            'page_name' => 'Perusahaan',
            'action' => 'Delete',
        ]);

        // Bidang
        \App\Models\Page::create([
            'page_name' => 'Bidang',
            'action' => 'Create',
        ]);

        \App\Models\Page::create([
            'page_name' => 'Bidang',
            'action' => 'Read',
        ]);

        \App\Models\Page::create([
            'page_name' => 'Bidang',
            'action' => 'Update',
        ]);

        \App\Models\Page::create([
            'page_name' => 'Bidang',
            'action' => 'Delete',
        ]);

        // Sub Bidang
        \App\Models\Page::create([
            'page_name' => 'Sub Bidang',
            'action' => 'Create',
        ]);

        \App\Models\Page::create([
            'page_name' => 'Sub Bidang',
            'action' => 'Read',
        ]);

        \App\Models\Page::create([
            'page_name' => 'Sub Bidang',
            'action' => 'Update',
        ]);

        \App\Models\Page::create([
            'page_name' => 'Sub Bidang',
            'action' => 'Delete',
        ]);

        // Account
        \App\Models\Page::create([
            'page_name' => 'User',
            'action' => 'Create',
        ]);

        \App\Models\Page::create([
            'page_name' => 'User',
            'action' => 'Read',
        ]);

        \App\Models\Page::create([
            'page_name' => 'User',
            'action' => 'Update',
        ]);

        \App\Models\Page::create([
            'page_name' => 'User',
            'action' => 'Delete',
        ]);
    }
}
