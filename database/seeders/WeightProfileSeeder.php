<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class WeightProfileSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('weight_profiles')->insert([
            [
                'kebutuhan' => 'gaming',
                'bobot_cpu' => 0.25,
                'bobot_gpu' => 0.40,
                'bobot_ram' => 0.15,
                'bobot_storage' => 0.10,
                'bobot_psu' => 0.10,
            ],
            [
                'kebutuhan' => 'editing',
                'bobot_cpu' => 0.35,
                'bobot_gpu' => 0.25,
                'bobot_ram' => 0.25,
                'bobot_storage' => 0.10,
                'bobot_psu' => 0.05,
            ],
            [
                'kebutuhan' => 'office',
                'bobot_cpu' => 0.20,
                'bobot_gpu' => 0.05,
                'bobot_ram' => 0.20,
                'bobot_storage' => 0.15,
                'bobot_psu' => 0.10,
            ],
        ]);
    }
}
