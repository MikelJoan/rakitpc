<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Cpu;
use App\Models\Gpu;
use App\Models\Ram;
use App\Models\Motherboard;
use App\Models\Psu;
use App\Models\Storage;
use App\Models\Casing;
use Illuminate\Http\Request;

class ComponentController extends Controller
{
    /**
     * Peta nama kategori (dari URL) ke Model & konfigurasi field-nya.
     * Ini yang bikin controller ini "generic" — 1 kode buat 7 tabel.
     */
    private function config(string $kategori): array
    {
        $configs = [
            'cpus' => [
                'model' => Cpu::class,
                'label' => 'CPU',
                'fields' => [
                    'nama' => ['type' => 'text', 'label' => 'Nama'],
                    'socket' => ['type' => 'text', 'label' => 'Socket'],
                    'harga' => ['type' => 'number', 'label' => 'Harga (Rp)'],
                    'punya_igpu' => ['type' => 'checkbox', 'label' => 'Punya Integrated Graphics'],
                ],
            ],
            'gpus' => [
                'model' => Gpu::class,
                'label' => 'GPU',
                'fields' => [
                    'nama' => ['type' => 'text', 'label' => 'Nama'],
                    'watt_rekomendasi' => ['type' => 'number', 'label' => 'Watt Rekomendasi'],
                    'harga' => ['type' => 'number', 'label' => 'Harga (Rp)'],
                ],
            ],
            'rams' => [
                'model' => Ram::class,
                'label' => 'RAM',
                'fields' => [
                    'nama' => ['type' => 'text', 'label' => 'Nama'],
                    'tipe_ddr' => ['type' => 'text', 'label' => 'Tipe DDR'],
                    'kapasitas' => ['type' => 'number', 'label' => 'Kapasitas (GB)'],
                    'harga' => ['type' => 'number', 'label' => 'Harga (Rp)'],
                ],
            ],
            'motherboards' => [
                'model' => Motherboard::class,
                'label' => 'Motherboard',
                'fields' => [
                    'nama' => ['type' => 'text', 'label' => 'Nama'],
                    'socket' => ['type' => 'text', 'label' => 'Socket'],
                    'tipe_ram_supported' => ['type' => 'text', 'label' => 'Tipe RAM Didukung'],
                    'jumlah_slot_ram' => ['type' => 'number', 'label' => 'Jumlah Slot RAM'],
                    'kapasitas_maks_per_slot' => ['type' => 'number', 'label' => 'Kapasitas Maks per Slot (GB)'],
                    'form_factor' => ['type' => 'text', 'label' => 'Form Factor'],
                    'harga' => ['type' => 'number', 'label' => 'Harga (Rp)'],
                ],
            ],
            'psus' => [
                'model' => Psu::class,
                'label' => 'PSU',
                'fields' => [
                    'nama' => ['type' => 'text', 'label' => 'Nama'],
                    'kapasitas_watt' => ['type' => 'number', 'label' => 'Kapasitas Watt'],
                    'harga' => ['type' => 'number', 'label' => 'Harga (Rp)'],
                ],
            ],
            'storages' => [
                'model' => Storage::class,
                'label' => 'Storage',
                'fields' => [
                    'nama' => ['type' => 'text', 'label' => 'Nama'],
                    'tipe' => ['type' => 'text', 'label' => 'Tipe (SSD/HDD)'],
                    'kapasitas' => ['type' => 'number', 'label' => 'Kapasitas (GB)'],
                    'harga' => ['type' => 'number', 'label' => 'Harga (Rp)'],
                ],
            ],
            'casings' => [
                'model' => Casing::class,
                'label' => 'Casing',
                'fields' => [
                    'nama' => ['type' => 'text', 'label' => 'Nama'],
                    'form_factor' => ['type' => 'text', 'label' => 'Form Factor'],
                    'harga' => ['type' => 'number', 'label' => 'Harga (Rp)'],
                ],
            ],
        ];

        abort_if(!isset($configs[$kategori]), 404);

        return $configs[$kategori];
    }

    public function index(string $kategori)
    {
        $config = $this->config($kategori);
        $items = $config['model']::orderBy('id', 'desc')->get();

        return view('admin.components.index', compact('kategori', 'config', 'items'));
    }

    public function create(string $kategori)
    {
        $config = $this->config($kategori);

        return view('admin.components.form', compact('kategori', 'config'));
    }

    public function store(Request $request, string $kategori)
    {
        $config = $this->config($kategori);
        $data = $this->validateData($request, $config);

        $config['model']::create($data);

        return redirect()->route('admin.components.index', $kategori)->with('success', 'Data berhasil ditambahkan.');
    }

    public function edit(string $kategori, int $id)
    {
        $config = $this->config($kategori);
        $item = $config['model']::findOrFail($id);

        return view('admin.components.form', compact('kategori', 'config', 'item'));
    }

    public function update(Request $request, string $kategori, int $id)
    {
        $config = $this->config($kategori);
        $item = $config['model']::findOrFail($id);
        $data = $this->validateData($request, $config);

        $item->update($data);

        return redirect()->route('admin.components.index', $kategori)->with('success', 'Data berhasil diperbarui.');
    }

    public function destroy(string $kategori, int $id)
    {
        $config = $this->config($kategori);
        $item = $config['model']::findOrFail($id);
        $item->delete();

        return redirect()->route('admin.components.index', $kategori)->with('success', 'Data berhasil dihapus.');
    }

    private function validateData(Request $request, array $config): array
    {
        $rules = [];
        foreach ($config['fields'] as $field => $meta) {
            $rules[$field] = match ($meta['type']) {
                'text' => 'required|string|max:255',
                'number' => 'required|numeric',
                'checkbox' => 'nullable|boolean',
                default => 'nullable',
            };
        }

        $validated = $request->validate($rules);

        // Checkbox yang tidak dicentang tidak terkirim sama sekali, set false manual
        foreach ($config['fields'] as $field => $meta) {
            if ($meta['type'] === 'checkbox') {
                $validated[$field] = $request->has($field);
            }
        }

        return $validated;
    }
}
