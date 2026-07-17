<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class RamSeeder extends Seeder
{
    public function run(): void
    {
        DB::table('rams')->insert([
            ['nama' => 'Corsair Vengeance LPX 8GB DDR4 3200MHz', 'tipe_ddr' => 'DDR4', 'kapasitas' => 8, 'harga' => 1350000],
            ['nama' => 'Corsair Vengeance LPX 16GB DDR4 3200MHz', 'tipe_ddr' => 'DDR4', 'kapasitas' => 16, 'harga' => 2550000],
            ['nama' => 'Team Elite 8GB DDR4 3200MHz', 'tipe_ddr' => 'DDR4', 'kapasitas' => 8, 'harga' => 1200000],
            ['nama' => 'Team Elite 16GB DDR4 3200MHz', 'tipe_ddr' => 'DDR4', 'kapasitas' => 16, 'harga' => 2250000],
            ['nama' => 'G.Skill Ripjaws V 8GB DDR4 3200MHz', 'tipe_ddr' => 'DDR4', 'kapasitas' => 8, 'harga' => 1440000],
            ['nama' => 'G.Skill Ripjaws V 16GB DDR4 3600MHz', 'tipe_ddr' => 'DDR4', 'kapasitas' => 16, 'harga' => 2700000],
            ['nama' => 'V-Gen 8GB DDR4 3200MHz', 'tipe_ddr' => 'DDR4', 'kapasitas' => 8, 'harga' => 1050000],
            ['nama' => 'V-Gen 16GB DDR4 3200MHz', 'tipe_ddr' => 'DDR4', 'kapasitas' => 16, 'harga' => 1950000],
            ['nama' => 'ADATA XPG Gammix D10 8GB DDR4 3200MHz', 'tipe_ddr' => 'DDR4', 'kapasitas' => 8, 'harga' => 1260000],
            ['nama' => 'ADATA XPG Gammix D10 16GB DDR4 3200MHz', 'tipe_ddr' => 'DDR4', 'kapasitas' => 16, 'harga' => 2400000],
            ['nama' => 'Corsair Vengeance 8GB DDR5 5200MHz', 'tipe_ddr' => 'DDR5', 'kapasitas' => 8, 'harga' => 1950000],
            ['nama' => 'Corsair Vengeance 16GB DDR5 5600MHz', 'tipe_ddr' => 'DDR5', 'kapasitas' => 16, 'harga' => 3600000],
            ['nama' => 'Corsair Vengeance 32GB DDR5 6000MHz', 'tipe_ddr' => 'DDR5', 'kapasitas' => 32, 'harga' => 7200000],
            ['nama' => 'G.Skill Trident Z5 16GB DDR5 6000MHz', 'tipe_ddr' => 'DDR5', 'kapasitas' => 16, 'harga' => 4200000],
            ['nama' => 'G.Skill Trident Z5 32GB DDR5 6000MHz', 'tipe_ddr' => 'DDR5', 'kapasitas' => 32, 'harga' => 8100000],
            ['nama' => 'Team T-Force 16GB DDR5 5200MHz', 'tipe_ddr' => 'DDR5', 'kapasitas' => 16, 'harga' => 3300000],
            ['nama' => 'Team T-Force 32GB DDR5 5600MHz', 'tipe_ddr' => 'DDR5', 'kapasitas' => 32, 'harga' => 6600000],
            ['nama' => 'Kingston Fury Beast 16GB DDR5 5200MHz', 'tipe_ddr' => 'DDR5', 'kapasitas' => 16, 'harga' => 3450000],
            ['nama' => 'Kingston Fury Beast 32GB DDR5 5600MHz', 'tipe_ddr' => 'DDR5', 'kapasitas' => 32, 'harga' => 6900000],
            ['nama' => 'Corsair Dominator Platinum 32GB DDR5 6200MHz', 'tipe_ddr' => 'DDR5', 'kapasitas' => 32, 'harga' => 9300000],
        ]);
    }
}
