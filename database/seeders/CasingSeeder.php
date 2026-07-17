<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class CasingSeeder extends Seeder
{
    public function run(): void
    {
        DB::table('casings')->insert([
            ['nama' => 'Cooler Master MasterBox Q300L', 'form_factor' => 'Micro-ATX', 'harga' => 650000],
            ['nama' => 'Xigmatek Aquarius Micro', 'form_factor' => 'Micro-ATX', 'harga' => 600000],
            ['nama' => 'Cougar MX330', 'form_factor' => 'ATX', 'harga' => 750000],
            ['nama' => 'Cooler Master MasterBox NR400', 'form_factor' => 'ATX', 'harga' => 1000000],
            ['nama' => 'NZXT H510', 'form_factor' => 'ATX', 'harga' => 1600000],
            ['nama' => 'Corsair 4000D Airflow', 'form_factor' => 'ATX', 'harga' => 1800000],
            ['nama' => 'Deepcool Macube 110', 'form_factor' => 'Mini-ITX', 'harga' => 800000],
            ['nama' => 'Cooler Master NR200', 'form_factor' => 'Mini-ITX', 'harga' => 1500000],
            ['nama' => 'Fractal Design Core 1000', 'form_factor' => 'Micro-ATX', 'harga' => 850000],
            ['nama' => 'Cooler Master MasterBox Q300P', 'form_factor' => 'Micro-ATX', 'harga' => 700000],
        ]);
    }
}
