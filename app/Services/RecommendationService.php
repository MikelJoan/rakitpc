<?php

namespace App\Services;

use App\Models\Cpu;
use App\Models\Gpu;
use App\Models\Ram;
use App\Models\Motherboard;
use App\Models\Psu;
use App\Models\Storage;
use App\Models\Casing;
use App\Models\WeightProfile;

class RecommendationService
{
    protected ExpertSystemService $expertSystem;
    protected DssService $dss;

    // Reserve budget untuk komponen wajib yang tidak ada di weight_profiles
    private const RESERVE_MOTHERBOARD = 0.15;
    private const RESERVE_CASING = 0.08;

    public function __construct(ExpertSystemService $expertSystem, DssService $dss)
    {
        $this->expertSystem = $expertSystem;
        $this->dss = $dss;
    }

    public function rekomendasikan(float $budget, string $kebutuhan): array
    {
        $profile = WeightProfile::where('kebutuhan', $kebutuhan)->first();

        if (!$profile) {
            return ['sukses' => false, 'pesan' => 'Profil kebutuhan tidak ditemukan.'];
        }

        // 1. Sisihkan reserve untuk Motherboard & Casing dulu
        $alokasiMotherboard = $budget * self::RESERVE_MOTHERBOARD;
        $alokasiCasing = $budget * self::RESERVE_CASING;
        $budgetUtama = $budget * (1 - self::RESERVE_MOTHERBOARD - self::RESERVE_CASING);

        // 2. Alokasi sisa budget (budgetUtama) ke 5 kategori sesuai bobot
        $alokasi = [
            'cpu' => $budgetUtama * $profile->bobot_cpu,
            'gpu' => $budgetUtama * $profile->bobot_gpu,
            'ram' => $budgetUtama * $profile->bobot_ram,
            'storage' => $budgetUtama * $profile->bobot_storage,
            'psu' => $budgetUtama * $profile->bobot_psu,
        ];

        // 3. Pilih CPU
        $kandidatCpu = Cpu::where('harga', '<=', $alokasi['cpu'])->get();
        if ($kandidatCpu->isEmpty()) {
            return ['sukses' => false, 'pesan' => 'Tidak ditemukan CPU yang sesuai dengan budget. Silakan naikkan budget Anda.'];
        }
        $cpu = $this->dss->pilihTerbaik($kandidatCpu, $profile->bobot_cpu);

        // 4. Pilih Motherboard yang kompatibel dengan CPU, dalam alokasi reserve
        $kandidatMobo = Motherboard::where('harga', '<=', $alokasiMotherboard)->get()->filter(function ($mobo) use ($cpu) {
            return $this->expertSystem->isCompatible('cpus', $cpu, 'motherboards', $mobo);
        });
        if ($kandidatMobo->isEmpty()) {
            return ['sukses' => false, 'pesan' => 'Tidak ditemukan Motherboard yang kompatibel dan sesuai budget. Silakan naikkan budget Anda.'];
        }
        $motherboard = $kandidatMobo->sortBy('harga')->first();

        // 5. Pilih RAM yang kompatibel dengan Motherboard
        $kandidatRam = Ram::where('harga', '<=', $alokasi['ram'])->get()->filter(function ($ram) use ($motherboard) {
            return $this->expertSystem->isCompatible('rams', $ram, 'motherboards', $motherboard);
        });
        if ($kandidatRam->isEmpty()) {
            return ['sukses' => false, 'pesan' => 'Tidak ditemukan RAM yang kompatibel dan sesuai budget. Silakan naikkan budget Anda.'];
        }
        $ram = $this->dss->pilihTerbaik($kandidatRam, $profile->bobot_ram);

        // 6. Pilih GPU (opsi "Tanpa GPU" hanya valid jika CPU punya integrated graphics)
        $kandidatGpu = Gpu::where('harga', '<=', $alokasi['gpu'])->get()->filter(function ($gpu) use ($cpu) {
            if ($gpu->harga == 0) {
                return $cpu->punya_igpu;
            }
            return true;
        });
        if ($kandidatGpu->isEmpty()) {
            return ['sukses' => false, 'pesan' => 'Tidak ditemukan GPU yang sesuai dengan budget. Silakan naikkan budget Anda.'];
        }
        $gpu = $this->dss->pilihTerbaik($kandidatGpu, $profile->bobot_gpu);

        // 7. Pilih PSU yang cukup untuk GPU (tidak dibatasi alokasi ketat karena mengikuti kebutuhan GPU)
        $kandidatPsu = Psu::all()->filter(function ($psu) use ($gpu) {
            return $this->expertSystem->isCompatible('psus', $psu, 'gpus', $gpu);
        });
        if ($kandidatPsu->isEmpty()) {
            return ['sukses' => false, 'pesan' => 'Tidak ditemukan PSU yang cukup daya untuk GPU terpilih.'];
        }
        $psu = $kandidatPsu->sortBy('harga')->first();

        // 8. Pilih Casing yang muat untuk Motherboard, dalam alokasi reserve
        $kandidatCasing = Casing::where('harga', '<=', $alokasiCasing)->get()->filter(function ($casing) use ($motherboard) {
            return $this->expertSystem->isCasingCompatible($casing, $motherboard);
        });
        if ($kandidatCasing->isEmpty()) {
            return ['sukses' => false, 'pesan' => 'Tidak ditemukan Casing yang sesuai untuk Motherboard terpilih dan budget. Silakan naikkan budget Anda.'];
        }
        $casing = $kandidatCasing->sortBy('harga')->first();

        // 9. Pilih Storage
        $kandidatStorage = Storage::where('harga', '<=', $alokasi['storage'])->get();
        if ($kandidatStorage->isEmpty()) {
            return ['sukses' => false, 'pesan' => 'Tidak ditemukan Storage yang sesuai dengan budget. Silakan naikkan budget Anda.'];
        }
        $storage = $this->dss->pilihTerbaik($kandidatStorage, $profile->bobot_storage);

        $totalHarga = $cpu->harga + $motherboard->harga + $ram->harga + $gpu->harga
            + $psu->harga + $casing->harga + $storage->harga;

        // Validasi akhir: pastikan total tidak melebihi budget keseluruhan
        if ($totalHarga > $budget) {
            return ['sukses' => false, 'pesan' => 'Kombinasi komponen yang kompatibel melebihi budget Anda. Silakan naikkan budget Anda.'];
        }

        return [
            'sukses' => true,
            'komponen' => [
                'cpu' => $cpu,
                'motherboard' => $motherboard,
                'ram' => $ram,
                'gpu' => $gpu,
                'psu' => $psu,
                'casing' => $casing,
                'storage' => $storage,
            ],
            'total_harga' => $totalHarga,
            'budget' => $budget,
        ];
    }
}
