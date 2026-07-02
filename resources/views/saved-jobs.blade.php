@extends('layouts.app')

@section('content')
<div class="mb-6">
    <h1 class="text-2xl font-bold text-gray-900">Pekerjaan Tersimpan</h1>
    <p class="text-gray-600 text-sm">Simpan lowongan menarik terlebih dahulu dan lamar kapan saja saat kamu siap.</p>
</div>

<div class="grid grid-cols-1 md:grid-cols-2 gap-6">
    <div class="bg-white border border-gray-200 rounded-2xl p-6 shadow-sm flex flex-col justify-between hover:border-teal-500 transition">
        <div>
            <div class="flex justify-between items-start">
                <div class="w-10 h-10 bg-amber-500 text-white rounded-xl flex items-center justify-center text-sm font-bold">
                    <i class="fa-solid fa-bolt"></i>
                </div>
                <button class="text-red-500 hover:text-red-700 bg-red-50 p-2 rounded-xl text-xs transition">
                    <i class="fa-solid fa-bookmark"></i>
                </button>
            </div>
            <div class="mt-4">
                <h3 class="text-xs font-bold text-gray-900">Asisten Tukang Bangunan</h3>
                <p class="text-[11px] text-gray-500 mt-0.5">Kontraktor Abadi • Bojongsoang</p>
            </div>
            <p class="text-xs text-gray-600 mt-3 line-clamp-2 leading-relaxed">
                Dibutuhkan asisten tukang untuk membantu pengangkutan material, pengadukan semen, dan persiapan area cor dak beton rumah dua lantai.
            </p>
            <div class="mt-4 flex items-center space-x-4 text-[11px] text-gray-400">
                <span><i class="fa-solid fa-money-bill-wave text-teal-600 mr-1"></i> Rp 120.000/hari</span>
                <span><i class="fa-solid fa-calendar-days text-gray-400 mr-1"></i> 4 Hari Kerja</span>
            </div>
        </div>
        <div class="mt-6 pt-4 border-t border-gray-100 flex items-center justify-between">
            <span class="text-[10px] text-gray-400 font-medium">Disimpan 2 hari lalu</span>
            <a href="{{ route('jobs.show', 1) }}" class="bg-[#007A87] hover:bg-teal-700 text-white font-bold px-4 py-2 rounded-xl text-xs transition">
                Lamar Sekarang
            </a>
        </div>
    </div>

    <div class="bg-white border border-gray-200 rounded-2xl p-6 shadow-sm flex flex-col justify-between hover:border-teal-500 transition">
        <div>
            <div class="flex justify-between items-start">
                <div class="w-10 h-10 bg-blue-600 text-white rounded-xl flex items-center justify-center text-sm font-bold">
                    <i class="fa-solid fa-tshirt"></i>
                </div>
                <button class="text-red-500 hover:text-red-700 bg-red-50 p-2 rounded-xl text-xs transition">
                    <i class="fa-solid fa-bookmark"></i>
                </button>
            </div>
            <div class="mt-4">
                <h3 class="text-xs font-bold text-gray-900">Setrika Pakaian Harian</h3>
                <p class="text-[11px] text-gray-500 mt-0.5">Laundry Kilat • Kota Cimahi</p>
            </div>
            <p class="text-xs text-gray-600 mt-3 line-clamp-2 leading-relaxed">
                Mencari tenaga harian khusus setrika uap untuk menyelesaikan tumpukan pakaian laundry kiloan yang sedang melonjak minggu ini.
            </p>
            <div class="mt-4 flex items-center space-x-4 text-[11px] text-gray-400">
                <span><i class="fa-solid fa-money-bill-wave text-teal-600 mr-1"></i> Rp 90.000/hari</span>
                <span><i class="fa-solid fa-calendar-days text-gray-400 mr-1"></i> 2 Hari Kerja</span>
            </div>
        </div>
        <div class="mt-6 pt-4 border-t border-gray-100 flex items-center justify-between">
            <span class="text-[10px] text-gray-400 font-medium">Disimpan kemarin</span>
            <a href="#" class="bg-[#007A87] hover:bg-teal-700 text-white font-bold px-4 py-2 rounded-xl text-xs transition">
                Lamar Sekarang
            </a>
        </div>
    </div>
</div>
@endsection