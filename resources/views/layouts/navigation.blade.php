<nav class="bg-white border-b border-gray-100 sticky top-0 z-50">
    <div class="max-w-7xl mx-auto px-6 h-20 flex justify-between items-center">
        <!-- Logo -->
        <div class="flex items-center gap-3">
            <div class="bg-[#f4b41a] text-white font-bold text-xl w-10 h-10 flex items-center justify-center rounded-xl shadow-sm">K</div>
            <div>
                <span class="text-lg font-black text-gray-950 tracking-tight block leading-none">KerjaHarian</span>
                <span class="text-[10px] text-gray-400 font-medium">kerja harian, bayar harian</span>
            </div>
        </div>
        
        <!-- Menu -->
        <div class="hidden md:flex items-center gap-8 text-xs font-bold text-gray-500">
            <a href="{{ route('jobs.index') }}" class="text-[#007A87] border-b-2 border-[#007A87] py-2">Cari Kerja</a>
            <a href="#" class="hover:text-[#007A87] transition">Dashboard</a>
            <a href="#" class="hover:text-[#007A87] transition">Lamaran Saya</a>
            <a href="#" class="hover:text-[#007A87] transition">Pesan</a>
            <a href="#" class="hover:text-[#007A87] transition flex items-center gap-1.5">
                Notifikasi <span class="bg-[#007A87] text-white text-[9px] w-4 h-4 flex items-center justify-center rounded-full">3</span>
            </a>
        </div>

        <!-- Profil -->
        <div class="flex items-center gap-3 border-l border-gray-100 pl-4">
            <img src="https://ui-avatars.com/api/?name={{ urlencode(Auth::user()->name ?? 'User') }}&background=007A87&color=fff" class="w-8 h-8 rounded-full shadow-sm" alt="Avatar">
            <span class="text-xs font-bold text-gray-800 flex items-center gap-1">
                Halo, {{ Auth::user()->name ?? 'User' }} <i class="fa-solid fa-chevron-down text-[10px] text-gray-400"></i>
            </span>
        </div>
    </div>
</nav>