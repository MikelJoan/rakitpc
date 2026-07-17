<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class StorageSeeder extends Seeder
{
    public function run(): void
    {
        DB::table('storages')->insert([
            ['nama' => 'WD Blue 1TB HDD', 'tipe' => 'HDD', 'kapasitas' => 1000, 'harga' => 950000],
            ['nama' => 'Seagate Barracuda 2TB HDD', 'tipe' => 'HDD', 'kapasitas' => 2000, 'harga' => 1250000],
            ['nama' => 'WD Blue 2TB HDD', 'tipe' => 'HDD', 'kapasitas' => 2000, 'harga' => 1300000],
            ['nama' => 'Kingston A400 240GB SATA SSD', 'tipe' => 'SSD', 'kapasitas' => 240, 'harga' => 510000],
            ['nama' => 'Kingston A400 480GB SATA SSD', 'tipe' => 'SSD', 'kapasitas' => 480, 'harga' => 820000],
            ['nama' => 'Samsung 870 EVO 500GB SATA SSD', 'tipe' => 'SSD', 'kapasitas' => 500, 'harga' => 1330000],
            ['nama' => 'Samsung 870 EVO 1TB SATA SSD', 'tipe' => 'SSD', 'kapasitas' => 1000, 'harga' => 2255000],
            ['nama' => 'WD Green 480GB SATA SSD', 'tipe' => 'SSD', 'kapasitas' => 480, 'harga' => 780000],
            ['nama' => 'Team MP33 512GB NVMe SSD', 'tipe' => 'SSD', 'kapasitas' => 512, 'harga' => 920000],
            ['nama' => 'WD Blue SN570 500GB NVMe SSD', 'tipe' => 'SSD', 'kapasitas' => 500, 'harga' => 1130000],
            ['nama' => 'WD Blue SN570 1TB NVMe SSD', 'tipe' => 'SSD', 'kapasitas' => 1000, 'harga' => 1950000],
            ['nama' => 'Samsung 980 500GB NVMe SSD', 'tipe' => 'SSD', 'kapasitas' => 500, 'harga' => 1330000],
            ['nama' => 'Samsung 980 1TB NVMe SSD', 'tipe' => 'SSD', 'kapasitas' => 1000, 'harga' => 2460000],
            ['nama' => 'Samsung 990 Pro 1TB NVMe Gen4 SSD', 'tipe' => 'SSD', 'kapasitas' => 1000, 'harga' => 3485000],
            ['nama' => 'Kingston NV2 1TB NVMe SSD', 'tipe' => 'SSD', 'kapasitas' => 1000, 'harga' => 1740000],
            ['nama' => 'Seagate Barracuda 1TB HDD', 'tipe' => 'HDD', 'kapasitas' => 1000, 'harga' => 1000000],
            ['nama' => 'Toshiba P300 1TB HDD', 'tipe' => 'HDD', 'kapasitas' => 1000, 'harga' => 980000],
            ['nama' => 'Adata Legend 710 512GB NVMe SSD', 'tipe' => 'SSD', 'kapasitas' => 512, 'harga' => 985000],
            ['nama' => 'Crucial P3 1TB NVMe SSD', 'tipe' => 'SSD', 'kapasitas' => 1000, 'harga' => 1845000],
            ['nama' => 'Samsung 990 Pro 2TB NVMe Gen4 SSD', 'tipe' => 'SSD', 'kapasitas' => 2000, 'harga' => 6560000],
        ]);
    }
}
