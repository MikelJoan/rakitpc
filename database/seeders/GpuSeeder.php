<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class GpuSeeder extends Seeder
{
    public function run(): void
    {
        DB::table('gpus')->insert([
            ['nama' => 'NVIDIA GTX 1650 4GB', 'watt_rekomendasi' => 300, 'harga' => 2150000],
            ['nama' => 'NVIDIA GTX 1660 Super 6GB', 'watt_rekomendasi' => 450, 'harga' => 2775000],
            ['nama' => 'NVIDIA RTX 3050 8GB', 'watt_rekomendasi' => 450, 'harga' => 3700000],
            ['nama' => 'NVIDIA RTX 3060 12GB', 'watt_rekomendasi' => 550, 'harga' => 5800000],
            ['nama' => 'NVIDIA RTX 3060 Ti 8GB', 'watt_rekomendasi' => 600, 'harga' => 6800000],
            ['nama' => 'NVIDIA RTX 3070 8GB', 'watt_rekomendasi' => 650, 'harga' => 7500000],
            ['nama' => 'NVIDIA RTX 4060 8GB', 'watt_rekomendasi' => 550, 'harga' => 6500000],
            ['nama' => 'NVIDIA RTX 4060 Ti 16GB', 'watt_rekomendasi' => 600, 'harga' => 8500000],
            ['nama' => 'NVIDIA RTX 4070 12GB', 'watt_rekomendasi' => 650, 'harga' => 11500000],
            ['nama' => 'NVIDIA RTX 5060 8GB', 'watt_rekomendasi' => 550, 'harga' => 7200000],
            ['nama' => 'NVIDIA RTX 5060 Ti 16GB', 'watt_rekomendasi' => 650, 'harga' => 9000000],
            ['nama' => 'NVIDIA RTX 5070 12GB', 'watt_rekomendasi' => 650, 'harga' => 13000000],
            ['nama' => 'NVIDIA RTX 5080 16GB', 'watt_rekomendasi' => 850, 'harga' => 26600000],
            ['nama' => 'AMD RX 6600 8GB', 'watt_rekomendasi' => 550, 'harga' => 4100000],
            ['nama' => 'AMD RX 6600 XT 8GB', 'watt_rekomendasi' => 650, 'harga' => 5900000],
            ['nama' => 'AMD RX 6700 XT 12GB', 'watt_rekomendasi' => 700, 'harga' => 7800000],
            ['nama' => 'AMD RX 7600 8GB', 'watt_rekomendasi' => 650, 'harga' => 6000000],
            ['nama' => 'AMD RX 7700 XT 12GB', 'watt_rekomendasi' => 700, 'harga' => 9500000],
            ['nama' => 'AMD RX 9060 XT 16GB', 'watt_rekomendasi' => 650, 'harga' => 9800000],
            ['nama' => 'AMD RX 9070 XT 16GB', 'watt_rekomendasi' => 750, 'harga' => 14000000],
        ]);
    }
}
