<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class CpuSeeder extends Seeder
{
    public function run(): void
    {
        DB::table('cpus')->insert([
            ['nama' => 'AMD Ryzen 3 4100', 'socket' => 'AM4', 'harga' => 1075000],
            ['nama' => 'AMD Ryzen 5 4600G', 'socket' => 'AM4', 'harga' => 1775000],
            ['nama' => 'AMD Ryzen 5 5600', 'socket' => 'AM4', 'harga' => 1975000],
            ['nama' => 'AMD Ryzen 5 5600G', 'socket' => 'AM4', 'harga' => 2075000],
            ['nama' => 'AMD Ryzen 5 5600X', 'socket' => 'AM4', 'harga' => 2375000],
            ['nama' => 'AMD Ryzen 7 5700X', 'socket' => 'AM4', 'harga' => 3720000],
            ['nama' => 'AMD Ryzen 7 5800X', 'socket' => 'AM4', 'harga' => 3675000],
            ['nama' => 'AMD Ryzen 9 5900X', 'socket' => 'AM4', 'harga' => 5375000],
            ['nama' => 'AMD Ryzen 5 7600', 'socket' => 'AM5', 'harga' => 3375000],
            ['nama' => 'AMD Ryzen 5 7600X', 'socket' => 'AM5', 'harga' => 3775000],
            ['nama' => 'AMD Ryzen 7 7700X', 'socket' => 'AM5', 'harga' => 4975000],
            ['nama' => 'AMD Ryzen 7 7800X3D', 'socket' => 'AM5', 'harga' => 7865000],
            ['nama' => 'AMD Ryzen 9 7900X', 'socket' => 'AM5', 'harga' => 7375000],
            ['nama' => 'AMD Ryzen 9 7950X', 'socket' => 'AM5', 'harga' => 9675000],
            ['nama' => 'Intel Core i3-12100F', 'socket' => 'LGA1700', 'harga' => 1575000],
            ['nama' => 'Intel Core i3-13100F', 'socket' => 'LGA1700', 'harga' => 1875000],
            ['nama' => 'Intel Core i5-12400F', 'socket' => 'LGA1700', 'harga' => 2500000],
            ['nama' => 'Intel Core i5-13400F', 'socket' => 'LGA1700', 'harga' => 2975000],
            ['nama' => 'Intel Core i5-13600K', 'socket' => 'LGA1700', 'harga' => 4675000],
            ['nama' => 'Intel Core i7-12700F', 'socket' => 'LGA1700', 'harga' => 4375000],
            ['nama' => 'Intel Core i7-13700K', 'socket' => 'LGA1700', 'harga' => 7000000],
            ['nama' => 'Intel Core i9-13900K', 'socket' => 'LGA1700', 'harga' => 9975000],
        ]);
    }
}
