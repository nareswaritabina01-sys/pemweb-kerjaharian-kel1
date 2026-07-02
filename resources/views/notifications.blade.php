@extends('layouts.app')

@section('content')
<div class="mb-6">
    <h1 class="text-2xl font-bold text-gray-900">Notifikasi</h1>
    <p class="text-gray-600 text-sm">Informasi terbaru mengenai pembaruan status lamaran dan pesan masuk kamu.</p>
</div>

<div class="bg-white border border-gray-200 rounded-2xl shadow-sm overflow-hidden divide-y divide-gray-100">
    <div class="p-4 flex items-start space-x-4 bg-teal-50/30 border-l-4 border-[#007A87]">
        <div class="w-9 h-9 bg-teal-50 text-[#007A87] rounded-xl flex items-center justify-center text-sm shrink-0">
            <i class="fa-solid fa-comment-dots"></i>
        </div>
        <div class="flex-1 min-w-0">
            <p class="text-xs text-gray-800"><span class="font-bold">Maju Jaya Furniture</span> mengirimkan pesan baru: "Bisa datang jam 8 pagi besok untuk pasang HPL?"</p>
            <span class="text-[10px] text-gray-400 block mt-1">15:41 • Pesan</span>
        </div>
        <div class="w-1.5 h-1.5 rounded-full bg-red-500 self-center"></div>
    </div>

    <div class="p-4 flex items-start space-x-4 hover:bg-gray-50/50 transition">
        <div class="w-9 h-9 bg-green-50 text-green-600 rounded-xl flex items-center justify-center text-sm shrink-0">
            <i class="fa-solid fa-circle-check"></i>
        </div>
        <div class="flex-1 min-w-0">
            <p class="text-xs text-gray-800">Selamat! Lamaran kamu di proyek <span class="font-bold">Pengecatan Pagar Rumah 1 Hari Selesai</span> telah diterima oleh penyedia kerja.</p>
            <span class="text-[10px] text-gray-400 block mt-1">Kemarin • Status Lamaran</span>
        </div>
    </div>

    <div class="p-4 flex items-start space-x-4 hover:bg-gray-50/50 transition">
        <div class="w-9 h-9 bg-blue-50 text-blue-600 rounded-xl flex items-center justify-center text-sm shrink-0">
            <i class="fa-solid fa-bullhorn"></i>
        </div>
        <div class="flex-1 min-w-0">
            <p class="text-xs text-gray-800">Sistem keamanan diperbarui. Pastikan profil data diri kamu sudah sesuai KTP asli demi kelancaran pencairan upah harian.</p>
            <span class="text-[10px] text-gray-400 block mt-1">3 hari lalu • Info Sistem</span>
        </div>
    </div>
</div>
@endsection