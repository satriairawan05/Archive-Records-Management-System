<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class BidangSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        \App\Models\Bidang::create([
            'com_id' => '1',
            'bid_name' => 'Lalu Lintas Angkutan Jalan',
            'bid_alias' => 'LLAJ'
        ]);
    }
}
