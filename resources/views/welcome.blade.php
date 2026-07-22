@extends('layouts.app')

@section('title', 'Racikin - Rekomendasi Rakitan PC Cerdas')

@section('content')

<section class="gradient-navy relative overflow-hidden">
    <div class="max-w-7xl mx-auto px-6 py-24 md:py-32 relative z-10">
        <div class="max-w-2xl">
            <span class="inline-block bg-sky-500/20 text-sky-300 text-sm font-semibold px-4 py-1.5 rounded-full mb-6 border border-sky-500/30">
                {{ __('AI-Powered Recommendation') }}
            </span>
            <h1 class="text-4xl md:text-5xl font-extrabold text-white leading-tight mb-6">
                {{ __('Rakit PC Impianmu,') }} <span class="text-sky-400">{{ __('Tanpa Ribet Mikir.') }}</span>
            </h1>
            <p class="text-slate-300 text-lg mb-8 leading-relaxed">
                {{ __('Cukup masukkan budget dan kebutuhanmu, sistem kami akan otomatis merekomendasikan kombinasi komponen PC yang kompatibel dan sesuai — tanpa perlu riset manual berjam-jam.') }}
            </p>
            <a href="{{ route('rekomendasi.form') }}" class="inline-flex items-center gap-2 bg-sky-500 hover:bg-sky-400 text-white font-semibold px-8 py-4 rounded-xl transition shadow-xl shadow-sky-500/20 text-lg">
                {{ __('Mulai Rekomendasi') }}
                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 7l5 5m0 0l-5 5m5-5H6" />
                </svg>
            </a>
        </div>
    </div>
    <div class="absolute top-1/2 -translate-y-1/2 right-0 w-96 h-96 bg-sky-500/10 rounded-full blur-3xl"></div>
</section>

<section class="bg-white -mt-1 relative z-10">
    <svg class="w-full h-16 -translate-y-full" viewBox="0 0 1440 100" preserveAspectRatio="none">
        <path fill="#f8fafc" d="M0,50 C480,120 960,0 1440,60 L1440,100 L0,100 Z"></path>
    </svg>
</section>

<section class="max-w-7xl mx-auto px-6 -mt-24 relative z-20 pb-20">
    <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
        <div class="bg-white rounded-2xl shadow-lg p-8 border border-slate-100">
            <div class="w-14 h-14 bg-sky-100 rounded-xl flex items-center justify-center mb-5">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-7 w-7 text-sky-600" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 3v2m6-2v2M9 19v2m6-2v2M5 9H3m2 6H3m18-6h-2m2 6h-2M7 19h10a2 2 0 002-2V7a2 2 0 00-2-2H7a2 2 0 00-2 2v10a2 2 0 002 2zM9 9h6v6H9V9z" />
                </svg>
            </div>
            <h3 class="text-lg font-bold text-slate-800 mb-2">{{ __('Kompatibilitas Terjamin') }}</h3>
            <p class="text-slate-500 text-sm leading-relaxed">{{ __('Sistem otomatis mengecek kecocokan socket, tipe RAM, wattage, dan form factor setiap komponen.') }}</p>
        </div>
        <div class="bg-white rounded-2xl shadow-lg p-8 border border-slate-100">
            <div class="w-14 h-14 bg-sky-100 rounded-xl flex items-center justify-center mb-5">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-7 w-7 text-sky-600" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 7h6m0 10v-3m-3 3v-6m-3 6v-9m-2 9h10a2 2 0 002-2V5a2 2 0 00-2-2H7a2 2 0 00-2 2v14a2 2 0 002 2z" />
                </svg>
            </div>
            <h3 class="text-lg font-bold text-slate-800 mb-2">{{ __('Sesuai Budget') }}</h3>
            <p class="text-slate-500 text-sm leading-relaxed">{{ __('Alokasi cerdas berdasarkan kebutuhanmu — gaming, editing, atau office — tanpa melebihi budget.') }}</p>
        </div>
        <div class="bg-white rounded-2xl shadow-lg p-8 border border-slate-100">
            <div class="w-14 h-14 bg-sky-100 rounded-xl flex items-center justify-center mb-5">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-7 w-7 text-sky-600" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 10V3L4 14h7v7l9-11h-7z" />
                </svg>
            </div>
            <h3 class="text-lg font-bold text-slate-800 mb-2">{{ __('Instan & Otomatis') }}</h3>
            <p class="text-slate-500 text-sm leading-relaxed">{{ __('Tidak perlu riset manual berjam-jam. Hasil rekomendasi lengkap dengan alasan pemilihan langsung tersedia.') }}</p>
        </div>
    </div>
</section>

@endsection