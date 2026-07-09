<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>KerjaHarian - Cari Kerja Harian Tanpa Ragu</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;500;600;700;800&display=swap" rel="stylesheet">
    <style>
        body { font-family: 'Plus Jakarta Sans', sans-serif; }
    </style>
</head>
<body class="bg-[#f8fafc] min-h-screen flex flex-col justify-between">

    <nav class="bg-white border-b border-gray-200 sticky top-0 z-50">
        <div class="max-w-7xl mx-auto px-6 h-16 flex justify-between items-center">
            <div class="flex items-center gap-8">
                <div class="flex items-center gap-3">
                    <div class="bg-[#f4b41a] text-white font-bold text-xl w-10 h-10 flex items-center justify-center rounded-xl shadow-sm">K</div>
                    <span class="text-lg font-black text-gray-950 tracking-tight">KerjaHarian</span>
                </div>
                <div class="hidden md:flex items-center gap-6 text-xs font-semibold text-gray-600">
                    <a href="{{ route('jobs.index') }}" class="hover:text-[#007A87] transition">Cari Lowongan</a>
                    <a href="{{ route('help') }}" class="hover:text-[#007A87] transition">Penyedia Jasa</a>
                    <a href="{{ route('help') }}" class="hover:text-[#007A87] transition">Mitra Kemitraan</a>
                </div>
            </div>
            <div class="flex items-center gap-4">
                <a href="{{ route('login') }}" class="text-xs font-bold text-gray-600 hover:text-[#007A87] transition">Masuk</a>
                <a href="{{ route('register') }}" class="bg-[#007A87] hover:bg-teal-700 text-white font-bold px-5 py-2 rounded-xl text-xs transition shadow-sm">Daftar</a>
            </div>
        </div>
    </nav>

    <main class="max-w-7xl w-full mx-auto px-6 py-8 flex-grow flex items-center justify-center">
        <div class="w-full bg-[#004D56] rounded-[2rem] p-8 md:p-16 shadow-xl text-white relative overflow-hidden flex flex-col items-start text-left">
            
            <h1 class="text-4xl md:text-6xl font-extrabold tracking-tight leading-tight max-w-2xl mb-4">
                Cari Kerja Harian<br>Tanpa Ragu
            </h1>
            
            <p class="text-teal-100 text-xs md:text-sm max-w-xl mb-8 leading-relaxed">
                Platform lowongan kerja harian terpercaya. Temukan berbagai pekerjaan harian mulai dari teknisi, administrasi, hingga tenaga lepas dengan sistem pembayaran aman dan transparan.
            </p>

            <div class="flex gap-3 mb-6">
                <a href="{{ route('jobs.index') }}" class="bg-[#f4b41a] text-gray-950 font-bold text-xs px-5 py-2.5 rounded-full shadow-sm transition hover:bg-yellow-500 inline-flex items-center justify-center">
                    Saya Ingin Bekerja
                </a>
                <a href="{{ route('help') }}" class="border border-white/40 hover:border-white text-white font-bold text-xs px-5 py-2.5 rounded-full transition bg-white/10 inline-flex items-center justify-center">
                    Saya Ingin Merekrut
                </a>
            </div>

            <form action="{{ route('jobs.index') }}" method="GET" class="w-full max-w-2xl bg-white p-2 rounded-xl md:rounded-full shadow-md flex flex-col md:flex-row items-center gap-2 mb-6">
                <div class="flex items-center gap-3 w-full pl-4 py-2 md:py-0">
                    <i class="fa-solid fa-magnifying-glass text-gray-400 text-sm"></i>
                    <input type="text" name="search" placeholder="Tulis keahlian, administrasi, atau lowongan yang kamu cari..." class="w-full text-xs text-gray-800 placeholder-gray-400 bg-transparent focus:outline-none">
                </div>
                <button type="submit" class="w-full md:w-auto bg-[#007A87] hover:bg-teal-700 text-white font-bold px-8 py-3 rounded-xl md:rounded-full text-xs transition whitespace-nowrap shadow-sm">
                    Cari Sekarang
                </button>
            </form>

            <div class="flex flex-wrap items-center gap-2 max-w-xl">
                <span class="text-[11px] font-bold text-teal-200 uppercase tracking-wider mr-1">Populer:</span>
                <a href="{{ route('jobs.index', ['search' => 'Web Development']) }}" class="bg-white/10 hover:bg-white/20 text-white border border-white/20 text-xs px-3 py-1 rounded-full transition">Web Development</a>
                <a href="{{ route('jobs.index', ['search' => 'E-Commerce Admin']) }}" class="bg-white/10 hover:bg-white/20 text-white border border-white/20 text-xs px-3 py-1 rounded-full transition">E-Commerce Admin</a>
                <a href="{{ route('jobs.index', ['search' => 'Desain Grafis']) }}" class="bg-white/10 hover:bg-white/20 text-white border border-white/20 text-xs px-3 py-1 rounded-full transition">Desain Grafis</a>
                <a href="{{ route('jobs.index', ['search' => 'Entry Data']) }}" class="bg-white/10 hover:bg-white/20 text-white border border-white/20 text-xs px-3 py-1 rounded-full transition">Entry Data</a>
            </div>

        </div>
    </main>

    <footer class="bg-white border-t border-gray-100 py-4 text-center text-gray-400 text-xs">
        &copy; 2026 KerjaHarian. Kelompok 1 - All Rights Reserved.
    </footer>

</body>
</html>