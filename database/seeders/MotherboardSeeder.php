<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class MotherboardSeeder extends Seeder
{
    public function run(): void
    {
        DB::table('motherboards')->insert([
            ['nama' => 'ASRock A520M-HDV', 'socket' => 'AM4', 'tipe_ram_supported' => 'DDR4', 'jumlah_slot_ram' => 2, 'kapasitas_maks_per_slot' => 32, 'form_factor' => 'Micro-ATX', 'harga' => 1250000],
            ['nama' => 'Gigabyte B450M DS3H', 'socket' => 'AM4', 'tipe_ram_supported' => 'DDR4', 'jumlah_slot_ram' => 4, 'kapasitas_maks_per_slot' => 32, 'form_factor' => 'Micro-ATX', 'harga' => 1350000],
            ['nama' => 'MSI B550M PRO-VDH', 'socket' => 'AM4', 'tipe_ram_supported' => 'DDR4', 'jumlah_slot_ram' => 4, 'kapasitas_maks_per_slot' => 32, 'form_factor' => 'Micro-ATX', 'harga' => 1700000],
            ['nama' => 'ASUS TUF Gaming B550-PLUS', 'socket' => 'AM4', 'tipe_ram_supported' => 'DDR4', 'jumlah_slot_ram' => 4, 'kapasitas_maks_per_slot' => 32, 'form_factor' => 'ATX', 'harga' => 2400000],
            ['nama' => 'Gigabyte B550 AORUS Elite', 'socket' => 'AM4', 'tipe_ram_supported' => 'DDR4', 'jumlah_slot_ram' => 4, 'kapasitas_maks_per_slot' => 32, 'form_factor' => 'ATX', 'harga' => 2600000],
            ['nama' => 'Biostar A520MH', 'socket' => 'AM4', 'tipe_ram_supported' => 'DDR4', 'jumlah_slot_ram' => 2, 'kapasitas_maks_per_slot' => 32, 'form_factor' => 'Micro-ATX', 'harga' => 1200000],
            ['nama' => 'MSI MAG B550 Tomahawk', 'socket' => 'AM4', 'tipe_ram_supported' => 'DDR4', 'jumlah_slot_ram' => 4, 'kapasitas_maks_per_slot' => 32, 'form_factor' => 'ATX', 'harga' => 2800000],
            ['nama' => 'ASRock B650M-HDV', 'socket' => 'AM5', 'tipe_ram_supported' => 'DDR5', 'jumlah_slot_ram' => 2, 'kapasitas_maks_per_slot' => 32, 'form_factor' => 'Micro-ATX', 'harga' => 2000000],
            ['nama' => 'MSI B650M PRO-A', 'socket' => 'AM5', 'tipe_ram_supported' => 'DDR5', 'jumlah_slot_ram' => 4, 'kapasitas_maks_per_slot' => 48, 'form_factor' => 'Micro-ATX', 'harga' => 2500000],
            ['nama' => 'ASUS TUF Gaming B650-PLUS', 'socket' => 'AM5', 'tipe_ram_supported' => 'DDR5', 'jumlah_slot_ram' => 4, 'kapasitas_maks_per_slot' => 48, 'form_factor' => 'ATX', 'harga' => 3300000],
            ['nama' => 'Gigabyte B650 AORUS Elite AX', 'socket' => 'AM5', 'tipe_ram_supported' => 'DDR5', 'jumlah_slot_ram' => 4, 'kapasitas_maks_per_slot' => 48, 'form_factor' => 'ATX', 'harga' => 3700000],
            ['nama' => 'ASUS ROG Strix X670E-E', 'socket' => 'AM5', 'tipe_ram_supported' => 'DDR5', 'jumlah_slot_ram' => 4, 'kapasitas_maks_per_slot' => 48, 'form_factor' => 'ATX', 'harga' => 7000000],
            ['nama' => 'Biostar B650MH', 'socket' => 'AM5', 'tipe_ram_supported' => 'DDR5', 'jumlah_slot_ram' => 2, 'kapasitas_maks_per_slot' => 48, 'form_factor' => 'Micro-ATX', 'harga' => 2200000],
            ['nama' => 'MSI MAG B650 Tomahawk', 'socket' => 'AM5', 'tipe_ram_supported' => 'DDR5', 'jumlah_slot_ram' => 4, 'kapasitas_maks_per_slot' => 48, 'form_factor' => 'ATX', 'harga' => 4000000],
            ['nama' => 'ASRock H610M-HDV', 'socket' => 'LGA1700', 'tipe_ram_supported' => 'DDR4', 'jumlah_slot_ram' => 2, 'kapasitas_maks_per_slot' => 32, 'form_factor' => 'Micro-ATX', 'harga' => 1100000],
            ['nama' => 'Gigabyte B660M DS3H', 'socket' => 'LGA1700', 'tipe_ram_supported' => 'DDR4', 'jumlah_slot_ram' => 4, 'kapasitas_maks_per_slot' => 32, 'form_factor' => 'Micro-ATX', 'harga' => 1600000],
            ['nama' => 'MSI PRO B760M-A', 'socket' => 'LGA1700', 'tipe_ram_supported' => 'DDR5', 'jumlah_slot_ram' => 4, 'kapasitas_maks_per_slot' => 48, 'form_factor' => 'Micro-ATX', 'harga' => 2300000],
            ['nama' => 'ASUS TUF Gaming B760-PLUS', 'socket' => 'LGA1700', 'tipe_ram_supported' => 'DDR5', 'jumlah_slot_ram' => 4, 'kapasitas_maks_per_slot' => 48, 'form_factor' => 'ATX', 'harga' => 3100000],
            ['nama' => 'Gigabyte Z790 AORUS Elite AX', 'socket' => 'LGA1700', 'tipe_ram_supported' => 'DDR5', 'jumlah_slot_ram' => 4, 'kapasitas_maks_per_slot' => 48, 'form_factor' => 'ATX', 'harga' => 4400000],
            ['nama' => 'ASRock B760M Pro RS', 'socket' => 'LGA1700', 'tipe_ram_supported' => 'DDR5', 'jumlah_slot_ram' => 4, 'kapasitas_maks_per_slot' => 48, 'form_factor' => 'Micro-ATX', 'harga' => 2100000],
        ]);
    }
}
