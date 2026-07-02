@extends('layouts.app')

@section('content')
<div class="mb-6">
    <h1 class="text-2xl font-bold text-gray-900">Pesan</h1>
    <p class="text-gray-600 text-sm">Hubungi penyedia kerja secara langsung untuk berdiskusi mengenai proyek harian.</p>
</div>

<div class="bg-white border border-gray-200 rounded-2xl shadow-sm overflow-hidden flex h-[calc(100vh-12rem)] min-h-[500px]">
    <div class="w-full md:w-80 border-r border-gray-200 flex flex-col bg-gray-50/50 shrink-0">
        <div class="p-4 border-b border-gray-200 bg-white">
            <div class="relative">
                <span class="absolute left-3 top-2.5 text-gray-400 text-xs"><i class="fa-solid fa-magnifying-glass"></i></span>
                <input type="text" placeholder="Cari percakapan..." class="w-full pl-9 pr-4 py-1.5 bg-gray-50 border border-gray-200 rounded-xl text-xs focus:outline-none focus:ring-1 focus:ring-[#007A87] focus:bg-white transition">
            </div>
        </div>

        <div class="flex-1 overflow-y-auto divide-y divide-gray-100 bg-white">
            <div class="p-4 flex items-start space-x-3 bg-teal-50/40 border-l-4 border-[#007A87] cursor-pointer">
                <div class="w-10 h-10 rounded-full bg-gray-200 flex items-center justify-center font-bold text-gray-600 shrink-0">M</div>
                <div class="flex-1 min-w-0">
                    <div class="flex justify-between items-baseline">
                        <h4 class="text-xs font-bold text-gray-900 truncate">Maju Jaya Furniture</h4>
                        <span class="text-[10px] text-[#007A87] font-bold">15:41</span>
                    </div>
                    <p class="text-[11px] text-gray-600 truncate mt-0.5 font-semibold">Bisa datang jam 8 pagi besok untuk pasang HPL?</p>
                </div>
                <div class="w-2 h-2 rounded-full bg-red-500 shrink-0 self-center mt-4"></div>
            </div>

            <div class="p-4 flex items-start space-x-3 hover:bg-gray-50 cursor-pointer transition">
                <div class="w-10 h-10 rounded-full bg-gray-200 flex items-center justify-center font-bold text-gray-600 shrink-0">P</div>
                <div class="flex-1 min-w-0">
                    <div class="flex justify-between items-baseline">
                        <h4 class="text-xs font-bold text-gray-900 truncate">PT. Bangun Sejahtera</h4>
                        <span class="text-[10px] text-gray-400">30 Jun</span>
                    </div>
                    <p class="text-[11px] text-gray-500 truncate mt-0.5">Lamaran Anda sudah kami setujui ya, ditunggu kedatangannya.</p>
                </div>
            </div>

            <div class="p-4 flex items-start space-x-3 hover:bg-gray-50 cursor-pointer transition">
                <div class="w-10 h-10 rounded-full bg-gray-200 flex items-center justify-center font-bold text-gray-600 shrink-0">PR</div>
                <div class="flex-1 min-w-0">
                    <div class="flex justify-between items-baseline">
                        <h4 class="text-xs font-bold text-gray-900 truncate">Pribadi (Pak Budi)</h4>
                        <span class="text-[10px] text-gray-400">25 Jun</span>
                    </div>
                    <p class="text-[11px] text-gray-500 truncate mt-0.5">Terima kasih atas bantuannya kemarin, kerjanya sangat rapi.</p>
                </div>
            </div>
        </div>
    </div>

    <div class="hidden md:flex flex-1 flex-col bg-white">
        <div class="px-6 py-4 border-b border-gray-200 flex items-center justify-between shadow-sm z-10 bg-white">
            <div class="flex items-center space-x-3">
                <div class="w-10 h-10 rounded-full bg-gray-200 flex items-center justify-center font-bold text-gray-600">M</div>
                <div>
                    <h3 class="text-xs font-bold text-gray-900">Maju Jaya Furniture</h3>
                    <span class="text-[10px] text-green-600 flex items-center mt-0.5">
                        <span class="w-1.5 h-1.5 rounded-full bg-green-500 block mr-1"></span> Online
                    </span>
                </div>
            </div>
            <button class="text-gray-400 hover:text-gray-600"><i class="fa-solid fa-ellipsis-vertical text-base"></i></button>
        </div>

        <div class="flex-1 p-6 overflow-y-auto bg-gray-50/50 space-y-4 flex flex-col">
            <div class="flex justify-center my-2">
                <span class="px-2.5 py-1 bg-gray-200/60 rounded-lg text-[10px] text-gray-500 font-medium">Hari Ini</span>
            </div>

            <div class="flex items-start space-x-2.5 max-w-lg">
                <div class="w-8 h-8 rounded-full bg-gray-200 flex items-center justify-center text-xs font-bold text-gray-600 shrink-0">M</div>
                <div class="bg-white border border-gray-100 rounded-2xl rounded-tl-none p-3 shadow-sm">
                    <p class="text-xs text-gray-800 leading-relaxed">Halo Andi, kami sudah melihat berkas lamaran dan profil pertukangan kayu Anda di KerjaHarian.</p>
                    <span class="text-[9px] text-gray-400 block text-right mt-1">15:30</span>
                </div>
            </div>

            <div class="flex items-start space-x-2.5 max-w-lg">
                <div class="w-8 h-8 rounded-full bg-gray-200 flex items-center justify-center text-xs font-bold text-gray-600 shrink-0">M</div>
                <div class="bg-white border border-gray-100 rounded-2xl rounded-tl-none p-3 shadow-sm">
                    <p class="text-xs text-gray-800 leading-relaxed">Kebetulan kami sedang mengejar deadline pembuatan lemari pakaian kustom berbahan plywood dan lapis HPL.</p>
                    <span class="text-[9px] text-gray-400 block text-right mt-1">15:31</span>
                </div>
            </div>

            <div class="flex items-start space-x-2.5 max-w-lg self-end justify-end">
                <div class="bg-[#007A87] text-white rounded-2xl rounded-tr-none p-3 shadow-sm">
                    <p class="text-xs leading-relaxed">Selamat sore Pak. Siap, saya sudah berpengalaman pasang HPL lemari selama lebih dari 2 tahun. Semua alat dasar pengerjaan juga saya punya lengkap.</p>
                    <span class="text-[9px] text-teal-100 block text-right mt-1">15:35</span>
                </div>
            </div>

            <div class="flex items-start space-x-2.5 max-w-lg">
                <div class="w-8 h-8 rounded-full bg-gray-200 flex items-center justify-center text-xs font-bold text-gray-600 shrink-0">M</div>
                <div class="bg-white border border-gray-100 rounded-2xl rounded-tl-none p-3 shadow-sm">
                    <p class="text-xs text-gray-800 leading-relaxed">Bagus kalau begitu. Bisa datang ke workshop kami di Cimahi Selatan jam 8 pagi besok untuk langsung mulai pasang HPL?</p>
                    <span class="text-[9px] text-gray-400 block text-right mt-1">15:41</span>
                </div>
            </div>
        </div>

        <div class="p-4 border-t border-gray-200 bg-white flex items-center space-x-3">
            <button class="text-gray-400 hover:text-gray-600 px-1"><i class="fa-solid fa-paperclip text-lg"></i></button>
            <div class="flex-1">
                <input type="text" placeholder="Ketik pesan di sini..." class="w-full px-4 py-2 bg-gray-50 border border-gray-200 rounded-xl text-xs focus:outline-none focus:ring-2 focus:ring-[#007A87] focus:bg-white transition">
            </div>
            <button class="bg-[#007A87] hover:bg-teal-700 text-white w-9 h-9 rounded-xl flex items-center justify-center transition shadow-sm shrink-0">
                <i class="fa-solid fa-paper-plane text-sm"></i>
            </button>
        </div>
    </div>
</div>
@endsection