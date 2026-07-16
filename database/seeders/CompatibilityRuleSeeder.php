<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class CompatibilityRuleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('compatibility_rules')->insert([
            [
                'kolom_a' => 'cpus',
                'atribut_a' => 'socket',
                'operator' => '=',
                'kolom_b' => 'motherboards',
                'atribut_b' => 'socket',
            ],
            [
                'kolom_a' => 'rams',
                'atribut_a' => 'tipe_ddr',
                'operator' => '=',
                'kolom_b' => 'motherboards',
                'atribut_b' => 'tipe_ram_supported',
            ],
            [
                'kolom_a' => 'rams',
                'atribut_a' => 'kapasitas',
                'operator' => '<=',
                'kolom_b' => 'motherboards',
                'atribut_b' => 'kapasitas_maks_per_slot',
            ],
            [
                'kolom_a' => 'psus',
                'atribut_a' => 'kapasitas_watt',
                'operator' => '>=',
                'kolom_b' => 'gpus',
                'atribut_b' => 'watt_rekomendasi',
            ],
        ]);
    }
}
