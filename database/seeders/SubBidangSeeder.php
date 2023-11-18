<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class SubBidangSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        \App\Models\SubBidang::create([
            'bid_id' => '1',
            'sub_name' => 'Lalu Lintas Jalan',
            'sub_alias' => 'LLJ',
        ]);

        \App\Models\SubBidang::create([
            'bid_id' => '1',
            'sub_name' => 'Perparkiran',
            'sub_alias' => 'PPR',
        ]);

        \App\Models\SubBidang::create([
            'bid_id' => '1',
            'sub_name' => 'Pengendalian dan Ketertiban',
            'sub_alias' => 'PnK',
        ]);
    }
}
