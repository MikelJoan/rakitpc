@extends('layouts.app')

@section('title', 'Hasil Rekomendasi - Racikin')

@section('content')

@if (!$hasil['sukses'])

<section class="max-w-2xl mx-auto px-6 py-24 text-center">
    <div class="w-20 h-20 bg-red-50 rounded-full flex items-center justify-center mx-auto mb-6">
        <svg xmlns="http://www.w3.org/2000/svg" class="h-10 w-10 text-red-400" fill="none" viewBox="0 0 24 24" stroke="currentColor">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z" />
        </svg>
    </div>
    <h1 class="text-2xl font-bold text-slate-800 mb-3">{{ __('Rekomendasi Tidak Ditemukan') }}</h1>
    <p class="text-slate-500 mb-8">{{ $hasil['pesan'] }}</p>
    <a href="{{ route('rekomendasi.form') }}" class="inline-flex items-center gap-2 bg-sky-500 hover:bg-sky-400 text-white font-semibold px-6 py-3 rounded-xl transition shadow-md">
        {{ __('Coba Lagi') }}
    </a>
</section>

@else

@php
    $komponen = $hasil['komponen'];
    $items = [
        ['label' => 'CPU', 'data' => $komponen['cpu'], 'sub' => $komponen['cpu']->socket],
        ['label' => 'Motherboard', 'data' => $komponen['motherboard'], 'sub' => $komponen['motherboard']->socket . ' • ' . $komponen['motherboard']->form_factor],
        ['label' => 'RAM', 'data' => $komponen['ram'], 'sub' => $komponen['ram']->tipe_ddr . ' • ' . $komponen['ram']->kapasitas . 'GB'],
        ['label' => 'GPU', 'data' => $komponen['gpu'], 'sub' => $komponen['gpu']->harga == 0 ? 'Grafis Onboard' : $komponen['gpu']->watt_rekomendasi . 'W rekomendasi'],
        ['label' => 'PSU', 'data' => $komponen['psu'], 'sub' => $komponen['psu']->kapasitas_watt . 'W'],
        ['label' => 'Storage', 'data' => $komponen['storage'], 'sub' => $komponen['storage']->tipe . ' • ' . $komponen['storage']->kapasitas . 'GB'],
        ['label' => 'Casing', 'data' => $komponen['casing'], 'sub' => $komponen['casing']->form_factor],
    ];
    $sisaBudget = $hasil['budget'] - $hasil['total_harga'];
    $warnaAlokasi = [
        'CPU' => 'bg-sky-500', 'GPU' => 'bg-blue-600', 'RAM' => 'bg-cyan-400',
        'Storage' => 'bg-indigo-400', 'PSU' => 'bg-sky-300',
        'Motherboard' => 'bg-slate-400', 'Casing' => 'bg-slate-300',
    ];
@endphp

<section class="gradient-navy py-16">
    <div class="max-w-4xl mx-auto px-6 text-center">
        <span class="inline-block bg-emerald-500/20 text-emerald-300 text-sm font-semibold px-4 py-1.5 rounded-full mb-4 border border-emerald-500/30">
            ✓ {{ __('Kombinasi Kompatibel Ditemukan') }}
        </span>
        <h1 class="text-3xl md:text-4xl font-extrabold text-white mb-3">{{ __('Rekomendasi Rakitan PC Kamu') }}</h1>
        <p class="text-slate-300">{{ __('berdasarkan budget') }} Rp {{ number_format($hasil['budget'], 0, ',', '.') }} {{ __('untuk kebutuhan') }} {{ __(ucfirst(request('kebutuhan') ?? '')) }}</p>
    </div>
</section>

<section class="max-w-4xl mx-auto px-6 -mt-10 pb-24 relative z-10">

    <div class="bg-white rounded-2xl shadow-xl border border-slate-100 p-6 md:p-8 mb-6">
        <div class="flex flex-col md:flex-row justify-between items-start md:items-center gap-4">
            <div>
                <p class="text-sm text-slate-400 mb-1">{{ __('Total Harga Rakitan') }}</p>
                <p class="text-3xl font-extrabold text-slate-800">Rp {{ number_format($hasil['total_harga'], 0, ',', '.') }}</p>
            </div>
            <div class="text-left md:text-right">
                <p class="text-sm text-slate-400 mb-1">{{ __('Sisa dari Budget') }}</p>
                <p class="text-xl font-bold text-emerald-500">Rp {{ number_format($sisaBudget, 0, ',', '.') }}</p>
            </div>
        </div>
    </div>

    <div class="grid grid-cols-1 md:grid-cols-2 gap-4 mb-6">
        @foreach ($items as $item)
        <div class="bg-white rounded-2xl shadow-md border border-slate-100 p-6 flex items-start gap-4">
            <div class="h-12 px-3 bg-sky-100 rounded-xl flex items-center justify-center shrink-0">
                <span class="text-sky-600 font-bold text-xs whitespace-nowrap">{{ $item['label'] }}</span>
            </div>
            <div class="flex-1 min-w-0">
                <p class="font-semibold text-slate-800 leading-snug">{{ $item['data']->nama }}</p>
                <p class="text-xs text-slate-400 mt-1">{{ $item['sub'] }}</p>
                <p class="text-sky-600 font-bold text-sm mt-2">
                    {{ $item['data']->harga == 0 ? __('Gratis (Bawaan CPU)') : 'Rp ' . number_format($item['data']->harga, 0, ',', '.') }}
                </p>
            </div>
        </div>
        @endforeach
    </div>

    <div class="bg-white rounded-2xl shadow-md border border-slate-100 p-6 md:p-8 mb-6">
        <h3 class="font-bold text-slate-800 mb-1">{{ __('Alokasi Budget per Kategori') }}</h3>
        <p class="text-xs text-slate-400 mb-5">{{ __('Perhitungan DSS (SAW) membagi budget berdasarkan bobot kebutuhan') }} {{ __(ucfirst(request('kebutuhan') ?? '')) }}</p>

        <div class="w-full h-8 rounded-full overflow-hidden flex mb-4 shadow-inner bg-slate-100">
            @foreach ($hasil['alokasi_budget'] as $label => $persen)
                <div class="{{ $warnaAlokasi[$label] }} h-full flex items-center justify-center" style="width: {{ $persen * 100 }}%" title="{{ $label }}: {{ round($persen * 100) }}%"></div>
            @endforeach
        </div>

        <div class="flex flex-wrap gap-x-5 gap-y-2">
            @foreach ($hasil['alokasi_budget'] as $label => $persen)
                <div class="flex items-center gap-2">
                    <span class="w-3 h-3 rounded-full {{ $warnaAlokasi[$label] }}"></span>
                    <span class="text-xs text-slate-500">{{ $label }} <span class="font-semibold text-slate-700">{{ round($persen * 100) }}%</span></span>
                </div>
            @endforeach
        </div>
    </div>

    <div class="bg-emerald-50 border border-emerald-200 rounded-2xl p-6 mb-6">
        <div class="flex items-center gap-2 mb-4">
            <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 text-emerald-500 shrink-0" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z" />
            </svg>
            <p class="font-semibold text-emerald-700 text-sm">{{ __('Verifikasi Kompatibilitas Sistem') }}</p>
        </div>
        <div class="space-y-2.5">
            @foreach ($hasil['rule_trace'] as $trace)
                <div class="flex items-start gap-2.5">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 text-emerald-500 shrink-0 mt-0.5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M5 13l4 4L19 7" />
                    </svg>
                    <p class="text-emerald-700 text-xs leading-relaxed">{{ $trace['pesan'] }}</p>
                </div>
            @endforeach
        </div>
    </div>

    <div class="bg-slate-100 border border-slate-200 rounded-2xl p-5 mb-6 flex items-start gap-3">
        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-slate-400 shrink-0 mt-0.5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
        </svg>
        <div>
            <p class="font-semibold text-slate-600 text-sm">{{ __('Catatan') }}</p>
            <p class="text-slate-500 text-xs mt-1 leading-relaxed">{{ __('Rekomendasi ini mencakup komponen inti (CPU, Motherboard, RAM, GPU, PSU, Storage, Casing). Komponen tambahan seperti kipas CPU/casing, thermal paste, dan kabel dapat disesuaikan sendiri sesuai selera dan kebutuhan Anda.') }}</p>
        </div>
    </div>

    <div class="flex flex-col sm:flex-row gap-3">
        <a href="{{ route('rekomendasi.form') }}" class="flex-1 text-center bg-white border border-slate-200 hover:bg-slate-50 text-slate-700 font-semibold py-3.5 rounded-xl transition">
            {{ __('Coba Budget Lain') }}
        </a>
        <a href="{{ route('home') }}" class="flex-1 text-center bg-sky-500 hover:bg-sky-400 text-white font-semibold py-3.5 rounded-xl transition shadow-md">
            {{ __('Kembali ke Beranda') }}
        </a>
    </div>

</section>

@endif

@endsection