<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class CompanySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        \App\Models\Company::create([
            'com_name' => 'Dinas Perhubungan Kota Samarinda',
            'com_alias' => 'DISHUB',
            'com_address' => 'Air Putih, Kec. Samarinda Ulu, Kota Samarinda, Kalimantan Timur 75243',
            'com_phone' => '(0541) 748537',
        ]);
    }
}
