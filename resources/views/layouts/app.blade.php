<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'RakitPC - Rekomendasi Rakitan PC Cerdas')</title>
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

    <nav class="gradient-navy sticky top-0 z-50 shadow-lg">
        <div class="max-w-7xl mx-auto px-6 py-4 flex justify-between items-center">
            <a href="{{ route('home') }}" class="flex items-center gap-2 text-white font-bold text-xl">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-7 w-7 text-sky-400" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9.75 17L9 20l-1 1h8l-1-1-.75-3M3 13h18M5 17h14a2 2 0 002-2V5a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z" />
                </svg>
                RakitPC
            </a>
            <div class="flex items-center gap-4">
                <a href="{{ route('home') }}" class="text-slate-200 hover:text-white transition text-sm font-medium">Beranda</a>
                <a href="{{ route('rekomendasi.form') }}" class="bg-sky-500 hover:bg-sky-400 text-white text-sm font-semibold px-5 py-2.5 rounded-lg transition shadow-md">
                    Mulai Rekomendasi
                </a>
            </div>
        </div>
    </nav>

    <main>
        @yield('content')
    </main>

    <footer class="gradient-navy text-slate-300 text-center py-6 mt-20 text-sm">
        <p>&copy; 2026 RakitPC — Sistem Rekomendasi Rakitan PC berbasis Expert System & DSS</p>
    </footer>

</body>
</html>