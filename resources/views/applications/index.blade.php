@extends('layouts.app')

@section('content')
<div class="mb-6">
    <h1 class="text-2xl font-bold text-gray-900">Lamaran Saya</h1>
    <p class="text-gray-600 text-sm">Pantau riwayat peninjauan dan status berkas lamaran kerja harian yang sudah kamu kirim.</p>
</div>

<div class="bg-white border border-gray-200 rounded-2xl shadow-sm overflow-hidden">
    <div class="border-b border-gray-200 px-6 py-4 flex space-x-6 text-xs font-bold">
        <button class="text-[#007A87] border-b-2 border-[#007A87] pb-4 -mb-4">Semua Lamaran</button>
        <button class="text-gray-500 hover:text-[#007A87] pb-4 -mb-4">Ditinjau (2)</button>
        <button class="text-gray-500 hover:text-[#007A87] pb-4 -mb-4">Diterima (1)</button>
        <button class="text-gray-500 hover:text-[#007A87] pb-4 -mb-4">Ditolak (0)</button>
    </div>

    <div class="divide-y divide-gray-100">
        <div class="p-6 flex flex-col md:flex-row md:items-center justify-between gap-4">
            <div class="flex items-start space-x-4">
                <div class="w-12 h-12 bg-gray-100 rounded-xl flex items-center justify-center text-gray-600 text-base shrink-0">
                    <i class="fa-solid fa-hammer"></i>
                </div>
                <div>
                    <h3 class="text-xs font-bold text-gray-900">Tukang Kayu Pembuatan Lemari</h3>
                    <p class="text-[11px] text-gray-500 mt-0.5">Maju Jaya Furniture • Cimahi Selatan</p>
                    <div class="flex items-center space-x-3 mt-2 text-[10px] text-gray-400">
                        <span><i class="fa-solid fa-money-bill-wave text-teal-600 mr-1"></i> Rp 150.000/hari</span>
                        <span><i class="fa-solid fa-calendar-days mr-1"></i> Dikirim Hari Ini</span>
                    </div>
                </div>
            </div>
            <div class="flex items-center justify-between md:justify-end gap-4 border-t md:border-t-0 pt-3 md:pt-0">
                <span class="px-2.5 py-1 bg-amber-50 text-amber-700 text-[10px] font-bold rounded-lg border border-amber-100">
                    <i class="fa-solid fa-clock mr-1"></i> Sedang Ditinjau
                </span>
                <a href="{{ route('jobs.show', 1) }}" class="text-xs font-bold text-gray-600 border border-gray-200 px-4 py-2 rounded-xl hover:bg-gray-50 transition">Detail</a>
            </div>
        </div>

        <div class="p-6 flex flex-col md:flex-row md:items-center justify-between gap-4">
            <div class="flex items-start space-x-4">
                <div class="w-12 h-12 bg-gray-100 rounded-xl flex items-center justify-center text-gray-600 text-base shrink-0">
                    <i class="fa-solid fa-brush"></i>
                </div>
                <div>
                    <h3 class="text-xs font-bold text-gray-900">Pengecatan Pagar Rumah 1 Hari Selesai</h3>
                    <p class="text-[11px] text-gray-500 mt-0.5">Pribadi (Pak Hermawan) • Margaasih</p>
                    <div class="flex items-center space-x-3 mt-2 text-[10px] text-gray-400">
                        <span><i class="fa-solid fa-money-bill-wave text-teal-600 mr-1"></i> Rp 140.000/hari</span>
                        <span><i class="fa-solid fa-calendar-days mr-1"></i> Dikirim 3 hari lalu</span>
                    </div>
                </div>
            </div>
            <div class="flex items-center justify-between md:justify-end gap-4 border-t md:border-t-0 pt-3 md:pt-0">
                <span class="px-2.5 py-1 bg-green-50 text-green-700 text-[10px] font-bold rounded-lg border border-green-100">
                    <i class="fa-solid fa-circle-check mr-1"></i> Lamaran Diterima
                </span>
                <a href="{{ route('messages') }}" class="text-xs font-bold text-white bg-[#007A87] px-4 py-2 rounded-xl hover:bg-teal-700 transition">Hubungi Penyedia</a>
            </div>
        </div>
    </div>
</div>
@endsection