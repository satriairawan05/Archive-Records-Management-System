<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class GroupPageSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        for ($i = 1; $i <= 35; $i++) {
            \App\Models\GroupPage::create([
                'group_id' => 1,
                'page_id' => $i,
                'access' => 1,
            ]);
        }
    }
}
