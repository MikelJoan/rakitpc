<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class PsuSeeder extends Seeder
{
    public function run(): void
    {
        DB::table('psus')->insert([
            ['nama' => 'Cooler Master MWE 450W', 'kapasitas_watt' => 450, 'harga' => 700000],
            ['nama' => 'Corsair CV450 450W', 'kapasitas_watt' => 450, 'harga' => 800000],
            ['nama' => 'Seasonic S12III 500W', 'kapasitas_watt' => 500, 'harga' => 900000],
            ['nama' => 'Cooler Master MWE 550W Bronze', 'kapasitas_watt' => 550, 'harga' => 950000],
            ['nama' => 'Corsair CV550 550W', 'kapasitas_watt' => 550, 'harga' => 1000000],
            ['nama' => 'FSP Hydro GE 550W', 'kapasitas_watt' => 550, 'harga' => 850000],
            ['nama' => 'Seasonic Focus GX 650W Gold', 'kapasitas_watt' => 650, 'harga' => 1550000],
            ['nama' => 'Corsair RM650 650W Gold', 'kapasitas_watt' => 650, 'harga' => 1650000],
            ['nama' => 'Cooler Master MWE 650W Gold', 'kapasitas_watt' => 650, 'harga' => 1250000],
            ['nama' => 'Corsair RM750 750W Gold', 'kapasitas_watt' => 750, 'harga' => 1950000],
            ['nama' => 'Seasonic Focus GX 750W Gold', 'kapasitas_watt' => 750, 'harga' => 1850000],
            ['nama' => 'FSP Hyper K 700W', 'kapasitas_watt' => 700, 'harga' => 1050000],
            ['nama' => 'Corsair RM850 850W Gold', 'kapasitas_watt' => 850, 'harga' => 2350000],
            ['nama' => 'Seasonic Focus GX 850W Gold', 'kapasitas_watt' => 850, 'harga' => 2250000],
            ['nama' => 'Cooler Master Elite 400W', 'kapasitas_watt' => 400, 'harga' => 700000],
            ['nama' => 'Corsair CX450 450W', 'kapasitas_watt' => 450, 'harga' => 850000],
            ['nama' => 'FSP Hexa Pro 500W', 'kapasitas_watt' => 500, 'harga' => 700000],
            ['nama' => 'Thermaltake Smart 600W', 'kapasitas_watt' => 600, 'harga' => 900000],
            ['nama' => 'Corsair CX650 650W', 'kapasitas_watt' => 650, 'harga' => 1100000],
            ['nama' => 'Cougar GEX 750W Gold', 'kapasitas_watt' => 750, 'harga' => 1750000],
        ]);
    }
}
