<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard Admin - Racikin</title>
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
            <div class="flex items-center gap-2 text-white font-bold text-lg sm:text-xl">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 sm:h-7 sm:w-7 text-sky-400" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9.75 17L9 20l-1 1h8l-1-1-.75-3M3 13h18M5 17h14a2 2 0 002-2V5a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z" />
                </svg>
                Racikin <span class="text-slate-400 font-normal text-sm">Admin</span>
            </div>
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
        <h1 class="text-2xl font-bold text-slate-800 mb-1">Dashboard Komponen</h1>
        <p class="text-slate-500 text-sm mb-8">Kelola data komponen PC yang dipakai sistem rekomendasi.</p>

        <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-4">

            <a href="{{ route('admin.components.index', 'cpus') }}" class="bg-white rounded-2xl shadow-md border border-slate-100 p-6 hover:shadow-lg hover:border-sky-200 transition">
                <div class="w-12 h-12 bg-sky-100 rounded-xl flex items-center justify-center mb-4">
                    <span class="text-sky-600 font-bold text-xs">CPU</span>
                </div>
                <p class="font-semibold text-slate-800">CPU</p>
                <p class="text-slate-400 text-sm">{{ $counts['cpus'] }} item</p>
            </a>

            <a href="{{ route('admin.components.index', 'gpus') }}" class="bg-white rounded-2xl shadow-md border border-slate-100 p-6 hover:shadow-lg hover:border-sky-200 transition">
                <div class="w-12 h-12 bg-sky-100 rounded-xl flex items-center justify-center mb-4">
                    <span class="text-sky-600 font-bold text-xs">GPU</span>
                </div>
                <p class="font-semibold text-slate-800">GPU</p>
                <p class="text-slate-400 text-sm">{{ $counts['gpus'] }} item</p>
            </a>

            <a href="{{ route('admin.components.index', 'rams') }}" class="bg-white rounded-2xl shadow-md border border-slate-100 p-6 hover:shadow-lg hover:border-sky-200 transition">
                <div class="w-12 h-12 bg-sky-100 rounded-xl flex items-center justify-center mb-4">
                    <span class="text-sky-600 font-bold text-xs">RAM</span>
                </div>
                <p class="font-semibold text-slate-800">RAM</p>
                <p class="text-slate-400 text-sm">{{ $counts['rams'] }} item</p>
            </a>

            <a href="{{ route('admin.components.index', 'motherboards') }}" class="bg-white rounded-2xl shadow-md border border-slate-100 p-6 hover:shadow-lg hover:border-sky-200 transition">
                <div class="w-12 h-12 bg-sky-100 rounded-xl flex items-center justify-center mb-4">
                    <span class="text-sky-600 font-bold text-xs">MB</span>
                </div>
                <p class="font-semibold text-slate-800">Motherboard</p>
                <p class="text-slate-400 text-sm">{{ $counts['motherboards'] }} item</p>
            </a>

            <a href="{{ route('admin.components.index', 'psus') }}" class="bg-white rounded-2xl shadow-md border border-slate-100 p-6 hover:shadow-lg hover:border-sky-200 transition">
                <div class="w-12 h-12 bg-sky-100 rounded-xl flex items-center justify-center mb-4">
                    <span class="text-sky-600 font-bold text-xs">PSU</span>
                </div>
                <p class="font-semibold text-slate-800">PSU</p>
                <p class="text-slate-400 text-sm">{{ $counts['psus'] }} item</p>
            </a>

            <a href="{{ route('admin.components.index', 'storages') }}" class="bg-white rounded-2xl shadow-md border border-slate-100 p-6 hover:shadow-lg hover:border-sky-200 transition">
                <div class="w-12 h-12 bg-sky-100 rounded-xl flex items-center justify-center mb-4">
                    <span class="text-sky-600 font-bold text-xs">SSD</span>
                </div>
                <p class="font-semibold text-slate-800">Storage</p>
                <p class="text-slate-400 text-sm">{{ $counts['storages'] }} item</p>
            </a>

            <a href="{{ route('admin.components.index', 'casings') }}" class="bg-white rounded-2xl shadow-md border border-slate-100 p-6 hover:shadow-lg hover:border-sky-200 transition">
                <div class="w-12 h-12 bg-sky-100 rounded-xl flex items-center justify-center mb-4">
                    <span class="text-sky-600 font-bold text-xs">CS</span>
                </div>
                <p class="font-semibold text-slate-800">Casing</p>
                <p class="text-slate-400 text-sm">{{ $counts['casings'] }} item</p>
            </a>

        </div>
    </div>

</body>
</html>