<?php

namespace App\Services;

use App\Models\CompatibilityRule;

class ExpertSystemService
{
    /**
     * Cek apakah 2 komponen kompatibel berdasarkan rule di database.
     * Contoh: isCompatible('cpus', $cpu, 'motherboards', $motherboard)
     */
    public function isCompatible(string $tableA, $itemA, string $tableB, $itemB): bool
    {
        $rules = CompatibilityRule::where('kolom_a', $tableA)
            ->where('kolom_b', $tableB)
            ->get();

        foreach ($rules as $rule) {
            $valueA = $itemA->{$rule->atribut_a};
            $valueB = $itemB->{$rule->atribut_b};

            if (!$this->evaluate($valueA, $rule->operator, $valueB)) {
                return false;
            }
        }

        return true;
    }

    /**
     * Jalankan perbandingan sesuai operator dari database.
     */
    private function evaluate($valueA, string $operator, $valueB): bool
    {
        return match ($operator) {
            '=' => $valueA == $valueB,
            '>=' => $valueA >= $valueB,
            '<=' => $valueA <= $valueB,
            '>' => $valueA > $valueB,
            '<' => $valueA < $valueB,
            default => false,
        };
    }

    /**
     * Rule khusus Casing-Motherboard (form factor).
     * Ini terpisah karena bukan perbandingan angka biasa,
     * tapi perbandingan "tingkatan" ukuran.
     */
    public function isCasingCompatible($casing, $motherboard): bool
    {
        $urutan = ['Mini-ITX' => 1, 'Micro-ATX' => 2, 'ATX' => 3];

        $levelCasing = $urutan[$casing->form_factor] ?? 0;
        $levelMotherboard = $urutan[$motherboard->form_factor] ?? 0;

        return $levelCasing >= $levelMotherboard;
    }
}
