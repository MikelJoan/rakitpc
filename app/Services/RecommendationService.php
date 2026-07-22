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

    private const RESERVE_MOTHERBOARD = 0.15;
    private const RESERVE_CASING = 0.08;

    private array $ruleTrace = [];

    public function __construct(ExpertSystemService $expertSystem, DssService $dss)
    {
        $this->expertSystem = $expertSystem;
        $this->dss = $dss;
    }

    /**
     * Hitung alokasi budget: setiap kategori dijamin dapat "jatah minimum"
     * setara harga komponen termurah, sisanya (surplus) baru dibagi
     * proporsional sesuai bobot kebutuhan.
     */
    private function hitungAlokasi(float $budgetUtama, object $profile, bool $butuhIgpu): ?array
    {
        $floorCpuQuery = Cpu::query();
        if ($butuhIgpu) {
            $floorCpuQuery->where('punya_igpu', true);
        }
        $floorCpu = $floorCpuQuery->min('harga');
        if ($floorCpu === null) {
            return null;
        }

        $floorRam = Ram::min('harga');
        $floorStorage = Storage::min('harga');
        $floorPsu = Psu::min('harga');

        $sumFloor = $floorCpu + $floorRam + $floorStorage + $floorPsu;
        $surplus = $budgetUtama - $sumFloor;

        if ($surplus < 0) {
            return null;
        }

        return [
            'cpu' => $floorCpu + $surplus * $profile->bobot_cpu,
            'gpu' => $surplus * $profile->bobot_gpu,
            'ram' => $floorRam + $surplus * $profile->bobot_ram,
            'storage' => $floorStorage + $surplus * $profile->bobot_storage,
            'psu' => $floorPsu + $surplus * $profile->bobot_psu,
            'floor_psu' => $floorPsu,
        ];
    }

    public function rekomendasikan(float $budget, string $kebutuhan): array
    {
        $this->ruleTrace = [];

        $profile = WeightProfile::where('kebutuhan', $kebutuhan)->first();

        if (!$profile) {
            return ['sukses' => false, 'pesan' => __('Profil kebutuhan tidak ditemukan.')];
        }

        $alokasiMotherboard = $budget * self::RESERVE_MOTHERBOARD;
        $alokasiCasing = $budget * self::RESERVE_CASING;
        $budgetUtama = $budget * (1 - self::RESERVE_MOTHERBOARD - self::RESERVE_CASING);

        $gpuTermurahDedicated = Gpu::where('harga', '>', 0)->min('harga');

        $alokasi = $this->hitungAlokasi($budgetUtama, $profile, false);
        if ($alokasi === null) {
            return ['sukses' => false, 'pesan' => __('Budget terlalu kecil untuk kombinasi komponen minimum. Silakan naikkan budget Anda.')];
        }

        $butuhIgpu = $alokasi['gpu'] < $gpuTermurahDedicated;
        if ($butuhIgpu) {
            $alokasi = $this->hitungAlokasi($budgetUtama, $profile, true);
            if ($alokasi === null) {
                return ['sukses' => false, 'pesan' => __('Budget terlalu kecil untuk kombinasi komponen minimum. Silakan naikkan budget Anda.')];
            }
        }

        // 3. Pilih CPU
        $kandidatCpu = Cpu::where('harga', '<=', $alokasi['cpu'])
            ->when($butuhIgpu, fn($query) => $query->where('punya_igpu', true))
            ->get();
        if ($kandidatCpu->isEmpty()) {
            return ['sukses' => false, 'pesan' => __('Tidak ditemukan CPU yang sesuai dengan budget. Silakan naikkan budget Anda.')];
        }
        $cpu = $this->dss->pilihTerbaik($kandidatCpu, $profile->bobot_cpu);

        // 4. Pilih Motherboard
        $kandidatMobo = Motherboard::where('harga', '<=', $alokasiMotherboard)->get()->filter(function ($mobo) use ($cpu) {
            return $this->expertSystem->isCompatible('cpus', $cpu, 'motherboards', $mobo);
        });
        if ($kandidatMobo->isEmpty()) {
            return ['sukses' => false, 'pesan' => __('Tidak ditemukan Motherboard yang kompatibel dan sesuai budget. Silakan naikkan budget Anda.')];
        }
        $motherboard = $kandidatMobo->sortBy('harga')->first();
        $this->ruleTrace[] = [
            'status' => true,
            'pesan' => __('Socket CPU (:a) cocok dengan Motherboard (:b)', ['a' => $cpu->socket, 'b' => $motherboard->socket]),
        ];

        // 5. Pilih RAM
        $kandidatRam = Ram::where('harga', '<=', $alokasi['ram'])->get()->filter(function ($ram) use ($motherboard) {
            return $this->expertSystem->isCompatible('rams', $ram, 'motherboards', $motherboard);
        });
        if ($kandidatRam->isEmpty()) {
            return ['sukses' => false, 'pesan' => __('Tidak ditemukan RAM yang kompatibel dan sesuai budget. Silakan naikkan budget Anda.')];
        }
        $ram = $this->dss->pilihTerbaik($kandidatRam, $profile->bobot_ram);
        $this->ruleTrace[] = [
            'status' => true,
            'pesan' => __('Tipe RAM (:a) cocok dengan Motherboard (:b)', ['a' => $ram->tipe_ddr, 'b' => $motherboard->tipe_ram_supported]),
        ];
        $this->ruleTrace[] = [
            'status' => true,
            'pesan' => __('Kapasitas RAM (:aGB) tidak melebihi maksimal slot Motherboard (:bGB)', ['a' => $ram->kapasitas, 'b' => $motherboard->kapasitas_maks_per_slot]),
        ];

        // 6. Pilih GPU
        $kandidatGpu = Gpu::where('harga', '<=', $alokasi['gpu'])->get()->filter(function ($gpu) use ($cpu) {
            if ($gpu->harga == 0) {
                return $cpu->punya_igpu;
            }
            return true;
        });
        if ($kandidatGpu->isEmpty()) {
            return ['sukses' => false, 'pesan' => __('Tidak ditemukan GPU yang sesuai dengan budget. Silakan naikkan budget Anda.')];
        }
        $gpu = $this->dss->pilihTerbaik($kandidatGpu, $profile->bobot_gpu);
        if ($gpu->harga == 0) {
            $this->ruleTrace[] = [
                'status' => true,
                'pesan' => __('CPU (:a) memiliki integrated graphics, GPU tambahan tidak diperlukan', ['a' => $cpu->nama]),
            ];
        }

        // 7. Pilih PSU
        $kandidatPsu = Psu::where('harga', '<=', max($alokasi['psu'], $alokasi['floor_psu']))->get()->filter(function ($psu) use ($gpu) {
            return $this->expertSystem->isCompatible('psus', $psu, 'gpus', $gpu);
        });
        if ($kandidatPsu->isEmpty()) {
            return ['sukses' => false, 'pesan' => __('Tidak ditemukan PSU yang cukup daya untuk GPU terpilih.')];
        }
        $psu = $kandidatPsu->sortBy('harga')->first();
        $this->ruleTrace[] = [
            'status' => true,
            'pesan' => __('Kapasitas PSU (:aW) mencukupi kebutuhan GPU (:bW rekomendasi)', ['a' => $psu->kapasitas_watt, 'b' => $gpu->watt_rekomendasi]),
        ];

        // 8. Pilih Casing
        $kandidatCasing = Casing::where('harga', '<=', $alokasiCasing)->get()->filter(function ($casing) use ($motherboard) {
            return $this->expertSystem->isCasingCompatible($casing, $motherboard);
        });
        if ($kandidatCasing->isEmpty()) {
            return ['sukses' => false, 'pesan' => __('Tidak ditemukan Casing yang sesuai untuk Motherboard terpilih dan budget. Silakan naikkan budget Anda.')];
        }
        $casing = $kandidatCasing->sortBy('harga')->first();
        $this->ruleTrace[] = [
            'status' => true,
            'pesan' => __('Form factor Casing (:a) mencukupi ukuran Motherboard (:b)', ['a' => $casing->form_factor, 'b' => $motherboard->form_factor]),
        ];

        // 9. Pilih Storage
        $kandidatStorage = Storage::where('harga', '<=', $alokasi['storage'])->get();
        if ($kandidatStorage->isEmpty()) {
            return ['sukses' => false, 'pesan' => __('Tidak ditemukan Storage yang sesuai dengan budget. Silakan naikkan budget Anda.')];
        }
        $storage = $this->dss->pilihTerbaik($kandidatStorage, $profile->bobot_storage);

        $totalHarga = $cpu->harga + $motherboard->harga + $ram->harga + $gpu->harga
            + $psu->harga + $casing->harga + $storage->harga;

        if ($totalHarga > $budget) {
            return ['sukses' => false, 'pesan' => __('Kombinasi komponen yang kompatibel melebihi budget Anda. Silakan naikkan budget Anda.')];
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
            'rule_trace' => $this->ruleTrace,
            'alokasi_budget' => [
                'CPU' => $profile->bobot_cpu,
                'GPU' => $profile->bobot_gpu,
                'RAM' => $profile->bobot_ram,
                'Storage' => $profile->bobot_storage,
                'PSU' => $profile->bobot_psu,
                'Motherboard' => self::RESERVE_MOTHERBOARD,
                'Casing' => self::RESERVE_CASING,
            ],
        ];
    }
}
