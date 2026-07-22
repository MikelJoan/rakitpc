@extends('layouts.app')

@section('title', 'Form Rekomendasi - Racikin')

@section('content')

<section class="gradient-navy py-16">
    <div class="max-w-3xl mx-auto px-6 text-center">
        <span class="inline-block bg-sky-500/20 text-sky-300 text-sm font-semibold px-4 py-1.5 rounded-full mb-4 border border-sky-500/30">
            {{ __('Langkah 1 dari 1') }}
        </span>
        <h1 class="text-3xl md:text-4xl font-extrabold text-white mb-3">{{ __('Ceritakan Kebutuhanmu') }}</h1>
        <p class="text-slate-300">{{ __('Masukkan budget dan pilih kebutuhan utama, sistem akan menghitung kombinasi terbaik untukmu.') }}</p>
    </div>
</section>

<section class="max-w-2xl mx-auto px-6 -mt-10 pb-24 relative z-10">
    <div class="bg-white rounded-2xl shadow-xl border border-slate-100 p-8 md:p-10">

        @if ($errors->any())
            <div class="mb-6 bg-red-50 border border-red-200 text-red-700 text-sm rounded-xl p-4">
                <ul class="list-disc list-inside space-y-1">
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <form action="{{ route('rekomendasi.proses') }}" method="POST" id="formRekomendasi" novalidate>
            @csrf

            <div class="mb-8">
                <label for="budget_display" class="block text-sm font-semibold text-slate-700 mb-2">{{ __('Budget Anda (Rp)') }}</label>
                <div class="relative">
                    <span class="absolute left-4 top-1/2 -translate-y-1/2 text-slate-400 font-medium">Rp</span>
                    <input type="text" id="budget_display" inputmode="numeric"
                        placeholder="10.000.000"
                        class="w-full pl-11 pr-4 py-4 bg-slate-50 border border-slate-200 rounded-xl text-slate-800 font-medium focus:outline-none focus:ring-2 focus:ring-sky-400 focus:border-transparent transition">
                    <input type="hidden" name="budget" id="budget">
                </div>
                <p class="text-xs text-slate-400 mt-2" id="budgetHint">{{ __('Minimal Rp 1.000.000. Jika kombinasi tidak ditemukan, sistem akan meminta Anda menaikkan budget.') }}</p>
                <p class="text-xs text-red-500 mt-2 hidden" id="budgetError">{{ __('Mohon isi budget terlebih dahulu.') }}</p>
            </div>

            <div class="mb-8">
                <label class="block text-sm font-semibold text-slate-700 mb-3">{{ __('Kebutuhan Utama') }}</label>
                <div class="grid grid-cols-1 md:grid-cols-3 gap-3" id="kebutuhanGroup">

                    <label class="cursor-pointer">
                        <input type="radio" name="kebutuhan" value="gaming" class="peer sr-only kebutuhan-radio">
                        <div class="border-2 border-slate-200 rounded-xl p-5 text-center peer-checked:border-sky-500 peer-checked:bg-sky-50 transition">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-8 w-8 mx-auto mb-2 text-slate-400 peer-checked:text-sky-500" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M15 7a2 2 0 012 2m4 0a6 6 0 01-7.743 5.743L11 17H9v2H7v2H4a1 1 0 01-1-1v-2.586a1 1 0 01.293-.707l5.964-5.964A6 6 0 1121 9z" />
                            </svg>
                            <p class="font-semibold text-slate-700 text-sm">{{ __('Gaming') }}</p>
                            <p class="text-xs text-slate-400 mt-1">{{ __('Performa GPU tinggi') }}</p>
                        </div>
                    </label>

                    <label class="cursor-pointer">
                        <input type="radio" name="kebutuhan" value="editing" class="peer sr-only kebutuhan-radio">
                        <div class="border-2 border-slate-200 rounded-xl p-5 text-center peer-checked:border-sky-500 peer-checked:bg-sky-50 transition">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-8 w-8 mx-auto mb-2 text-slate-400 peer-checked:text-sky-500" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M7 4v16M17 4v16M3 8h4m10 0h4M3 16h4m10 0h4M4 4h16v16H4V4z" />
                            </svg>
                            <p class="font-semibold text-slate-700 text-sm">{{ __('Editing') }}</p>
                            <p class="text-xs text-slate-400 mt-1">{{ __('CPU & RAM kuat') }}</p>
                        </div>
                    </label>

                    <label class="cursor-pointer">
                        <input type="radio" name="kebutuhan" value="office" class="peer sr-only kebutuhan-radio">
                        <div class="border-2 border-slate-200 rounded-xl p-5 text-center peer-checked:border-sky-500 peer-checked:bg-sky-50 transition">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-8 w-8 mx-auto mb-2 text-slate-400 peer-checked:text-sky-500" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M9 17V7m0 10a2 2 0 01-2 2H5a2 2 0 01-2-2V7a2 2 0 012-2h2a2 2 0 012 2m0 10a2 2 0 002 2h2a2 2 0 002-2M9 7a2 2 0 012-2h2a2 2 0 012 2m0 10V7m0 10a2 2 0 002 2h2a2 2 0 002-2V7a2 2 0 00-2-2h-2a2 2 0 00-2 2" />
                            </svg>
                            <p class="font-semibold text-slate-700 text-sm">{{ __('Office') }}</p>
                            <p class="text-xs text-slate-400 mt-1">{{ __('Ringan & hemat biaya') }}</p>
                        </div>
                    </label>

                </div>
                <p class="text-xs text-red-500 mt-2 hidden" id="kebutuhanError">{{ __('Silakan pilih salah satu kebutuhan utama.') }}</p>
            </div>

            <button type="submit" class="w-full bg-sky-500 hover:bg-sky-400 text-white font-semibold py-4 rounded-xl transition shadow-lg shadow-sky-500/20 flex items-center justify-center gap-2">
                {{ __('Dapatkan Rekomendasi') }}
                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 7l5 5m0 0l-5 5m5-5H6" />
                </svg>
            </button>

        </form>
    </div>
</section>

<script>
    const budgetDisplay = document.getElementById('budget_display');
    const budgetHidden = document.getElementById('budget');
    const budgetError = document.getElementById('budgetError');
    const kebutuhanError = document.getElementById('kebutuhanError');
    const kebutuhanRadios = document.querySelectorAll('.kebutuhan-radio');

    budgetDisplay.addEventListener('input', function (e) {
        let angka = e.target.value.replace(/\D/g, '');
        budgetHidden.value = angka;
        e.target.value = angka ? new Intl.NumberFormat('id-ID').format(angka) : '';
        if (angka) {
            budgetError.classList.add('hidden');
            budgetDisplay.classList.remove('border-red-400', 'ring-2', 'ring-red-200');
        }
    });

    kebutuhanRadios.forEach(radio => {
        radio.addEventListener('change', function () {
            kebutuhanError.classList.add('hidden');
        });
    });

    document.getElementById('formRekomendasi').addEventListener('submit', function (e) {
        let valid = true;

        if (!budgetHidden.value) {
            e.preventDefault();
            budgetError.classList.remove('hidden');
            budgetDisplay.classList.add('border-red-400', 'ring-2', 'ring-red-200');
            valid = false;
        }

        const kebutuhanTerpilih = Array.from(kebutuhanRadios).some(r => r.checked);
        if (!kebutuhanTerpilih) {
            e.preventDefault();
            kebutuhanError.classList.remove('hidden');
            valid = false;
        }

        if (!valid) {
            document.querySelector('.bg-red-500, #budgetError:not(.hidden), #kebutuhanError:not(.hidden)')?.scrollIntoView({ behavior: 'smooth', block: 'center' });
        }
    });
</script>

@endsection