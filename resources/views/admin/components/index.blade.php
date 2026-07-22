<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ $config['label'] }} - Admin Racikin</title>
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

    <div class="max-w-7xl mx-auto px-4 sm:px-6 py-10">

        <div class="flex items-center gap-2 text-sm text-slate-400 mb-4">
            <a href="{{ route('admin.dashboard') }}" class="hover:text-sky-500 transition">Dashboard</a>
            <span>/</span>
            <span class="text-slate-600 font-medium">{{ $config['label'] }}</span>
        </div>

        <div class="flex flex-col sm:flex-row sm:items-center justify-between gap-4 mb-6">
            <h1 class="text-2xl font-bold text-slate-800">Kelola {{ $config['label'] }}</h1>
            <a href="{{ route('admin.components.create', $kategori) }}" class="inline-flex items-center gap-2 bg-sky-500 hover:bg-sky-400 text-white font-semibold px-5 py-2.5 rounded-xl transition shadow-md text-sm">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4" />
                </svg>
                Tambah {{ $config['label'] }}
            </a>
        </div>

        @if (session('success'))
            <div class="mb-6 bg-emerald-50 border border-emerald-200 text-emerald-700 text-sm rounded-xl p-4">
                {{ session('success') }}
            </div>
        @endif

        <div class="bg-white rounded-2xl shadow-md border border-slate-100 overflow-hidden">
            <div class="overflow-x-auto">
                <table class="w-full text-sm">
                    <thead>
                        <tr class="bg-slate-50 border-b border-slate-200">
                            @foreach ($config['fields'] as $field => $meta)
                                <th class="text-left px-6 py-3 font-semibold text-slate-600 whitespace-nowrap">{{ $meta['label'] }}</th>
                            @endforeach
                            <th class="text-right px-6 py-3 font-semibold text-slate-600">Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse ($items as $item)
                            <tr class="border-b border-slate-100 hover:bg-slate-50 transition">
                                @foreach ($config['fields'] as $field => $meta)
                                    <td class="px-6 py-3 text-slate-700 whitespace-nowrap">
                                        @if ($meta['type'] === 'checkbox')
                                            @if ($item->$field)
                                                <span class="inline-flex items-center gap-1 text-emerald-600 font-medium">
                                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M5 13l4 4L19 7" /></svg>
                                                    Ya
                                                </span>
                                            @else
                                                <span class="text-slate-400">Tidak</span>
                                            @endif
                                        @elseif ($field === 'harga')
                                            Rp {{ number_format($item->harga, 0, ',', '.') }}
                                        @else
                                            {{ $item->$field }}
                                        @endif
                                    </td>
                                @endforeach
                                <td class="px-6 py-3 text-right whitespace-nowrap">
                                    <a href="{{ route('admin.components.edit', [$kategori, $item->id]) }}" class="text-sky-500 hover:text-sky-600 font-medium mr-4">Edit</a>
                                    <form action="{{ route('admin.components.destroy', [$kategori, $item->id]) }}" method="POST" class="inline" onsubmit="return confirm('Yakin hapus {{ $item->nama }}?');">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="text-red-500 hover:text-red-600 font-medium">Hapus</button>
                                    </form>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="{{ count($config['fields']) + 1 }}" class="px-6 py-10 text-center text-slate-400">
                                    Belum ada data.
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>

    </div>

</body>
</html>