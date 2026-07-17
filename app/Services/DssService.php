<?php

namespace App\Services;

class DssService
{
    /**
     * Hitung skor SAW untuk sekumpulan kandidat komponen.
     * Kriteria yang dipakai: harga (dinormalisasi, semakin tinggi harga = semakin baik performa).
     *
     * $kandidat = collection item (misal semua CPU yang lolos filter budget & compatibility)
     * $bobot = nilai bobot kategori ini dari weight_profiles (misal 0.25 untuk CPU di Gaming)
     */
    public function hitungSkor($kandidat, float $bobot)
    {
        if ($kandidat->isEmpty()) {
            return $kandidat;
        }

        $hargaMax = $kandidat->max('harga');
        $hargaMin = $kandidat->min('harga');

        // Hindari pembagian oleh nol kalau semua harga sama
        $range = $hargaMax - $hargaMin;

        return $kandidat->map(function ($item) use ($hargaMax, $hargaMin, $range, $bobot) {
            // Normalisasi: harga lebih tinggi = nilai lebih baik (benefit criteria)
            $normalisasi = $range > 0
                ? ($item->harga - $hargaMin) / $range
                : 1;

            $item->skor_saw = $normalisasi * $bobot;

            return $item;
        })->sortByDesc('skor_saw');
    }

    /**
     * Pilih 1 kandidat terbaik dari hasil hitungSkor().
     */
    public function pilihTerbaik($kandidat, float $bobot)
    {
        $hasil = $this->hitungSkor($kandidat, $bobot);

        return $hasil->first();
    }
}
