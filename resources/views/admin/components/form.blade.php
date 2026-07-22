<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ isset($item) ? 'Edit' : 'Tambah' }} {{ $config['label'] }} - Admin Racikin</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700;800&display=swap" rel="stylesheet">
    <style>
        body { font-family: 'Inter', sans-serif; }
        .gradient-navy {
            background: linear-gradient(135deg, #0f172a 0%, #1e3a5f 100%);
        }
    </style>
</head>
<body class="bg-slate-50">

    <nav class="gradient-navy shadow-lg">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 py-4 flex justify-between items-center">
            <a href="{{ route('admin.dashboard') }}" class="flex items-center gap-2 text-white font-bold text-lg sm:text-xl">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 sm:h-7 sm:w-7 text-sky-400" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9.75 17L9 20l-1 1h8l-1-1-.75-3M3 13h18M5 17h14a2 2 0 002-2V5a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z" />
                </svg>
                Racikin <span class="text-slate-400 font-normal text-sm">Admin</span>
            </a>
            <div class="flex items-center gap-3">
                <a href="{{ route('home') }}" class="hidden sm:inline text-slate-300 hover:text-white text-sm transition">Lihat Situs</a>
                <form action="{{ route('admin.logout') }}" method="POST">
                    @csrf
                    <button type="submit" class="bg-white/10 hover:bg-white/20 text-white text-sm font-medium px-4 py-2 rounded-lg transition">
                        Keluar
                    </button>
                </form>
            </div>
        </div>
    </nav>

    <div class="max-w-2xl mx-auto px-4 sm:px-6 py-10">

        <div class="flex items-center gap-2 text-sm text-slate-400 mb-4">
            <a href="{{ route('admin.dashboard') }}" class="hover:text-sky-500 transition">Dashboard</a>
            <span>/</span>
            <a href="{{ route('admin.components.index', $kategori) }}" class="hover:text-sky-500 transition">{{ $config['label'] }}</a>
            <span>/</span>
            <span class="text-slate-600 font-medium">{{ isset($item) ? 'Edit' : 'Tambah' }}</span>
        </div>

        <h1 class="text-2xl font-bold text-slate-800 mb-6">{{ isset($item) ? 'Edit' : 'Tambah' }} {{ $config['label'] }}</h1>

        @if ($errors->any())
            <div class="mb-6 bg-red-50 border border-red-200 text-red-700 text-sm rounded-xl p-4">
                <ul class="list-disc list-inside space-y-1">
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <div class="bg-white rounded-2xl shadow-md border border-slate-100 p-6 md:p-8">
            <form action="{{ isset($item) ? route('admin.components.update', [$kategori, $item->id]) : route('admin.components.store', $kategori) }}" method="POST">
                @csrf
                @if (isset($item))
                    @method('PUT')
                @endif

                @foreach ($config['fields'] as $field => $meta)
                    <div class="mb-5">
                        @if ($meta['type'] === 'checkbox')
                            <label class="flex items-center gap-3 cursor-pointer">
                                <input type="checkbox" name="{{ $field }}" value="1"
                                    {{ old($field, $item->$field ?? false) ? 'checked' : '' }}
                                    class="w-5 h-5 rounded border-slate-300 text-sky-500 focus:ring-sky-400">
                                <span class="text-sm font-semibold text-slate-700">{{ $meta['label'] }}</span>
                            </label>
                        @else
                            <label for="{{ $field }}" class="block text-sm font-semibold text-slate-700 mb-2">{{ $meta['label'] }}</label>
                            <input type="{{ $meta['type'] }}" name="{{ $field }}" id="{{ $field }}"
                                value="{{ old($field, $item->$field ?? '') }}"
                                class="w-full px-4 py-3 bg-slate-50 border border-slate-200 rounded-xl text-slate-800 focus:outline-none focus:ring-2 focus:ring-sky-400 focus:border-transparent transition"
                                @if ($meta['type'] === 'number') step="any" @endif
                                required>
                        @endif
                    </div>
                @endforeach

                <div class="flex gap-3 mt-8">
                    <a href="{{ route('admin.components.index', $kategori) }}" class="flex-1 text-center bg-white border border-slate-200 hover:bg-slate-50 text-slate-700 font-semibold py-3 rounded-xl transition">
                        Batal
                    </a>
                    <button type="submit" class="flex-1 bg-sky-500 hover:bg-sky-400 text-white font-semibold py-3 rounded-xl transition shadow-md">
                        Simpan
                    </button>
                </div>
            </form>
        </div>

    </div>

</body>
</html>