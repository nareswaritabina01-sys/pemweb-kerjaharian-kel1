@extends('layouts.app')

@section('content')
<div class="mb-6 text-center max-w-xl mx-auto">
    <h1 class="text-2xl font-bold text-gray-900">Pusat Bantuan KerjaHarian</h1>
    <p class="text-gray-600 text-sm mt-1">Punya kendala atau pertanyaan? Cari panduan dan jawaban instan di bawah ini.</p>
    <div class="relative mt-4 max-w-md mx-auto">
        <span class="absolute left-4 top-3.5 text-gray-400 text-xs"><i class="fa-solid fa-magnifying-glass text-sm"></i></span>
        <input type="text" placeholder="Ketik pertanyaan atau kata kunci..." class="w-full pl-11 pr-4 py-2.5 bg-white border border-gray-200 rounded-2xl text-xs shadow-sm focus:outline-none focus:ring-2 focus:ring-[#007A87] transition">
    </div>
</div>

<div class="grid grid-cols-1 md:grid-cols-3 gap-6 mb-8">
    <div class="bg-white border border-gray-200 rounded-2xl p-5 shadow-sm text-center">
        <div class="w-10 h-10 bg-teal-50 text-[#007A87] rounded-xl flex items-center justify-center mx-auto text-base"><i class="fa-solid fa-circle-info"></i></div>
        <h3 class="text-xs font-bold text-gray-900 mt-3">Panduan Melamar</h3>
        <p class="text-[11px] text-gray-500 mt-1">Langkah mudah mengajukan lamaran harian dari awal sampai diterima kerja.</p>
    </div>
    <div class="bg-white border border-gray-200 rounded-2xl p-5 shadow-sm text-center">
        <div class="w-10 h-10 bg-amber-50 text-amber-600 rounded-xl flex items-center justify-center mx-auto text-base"><i class="fa-solid fa-shield-halved"></i></div>
        <h3 class="text-xs font-bold text-gray-900 mt-3">Akun & Keamanan</h3>
        <p class="text-[11px] text-gray-500 mt-1">Cara verifikasi profil data diri menggunakan KTP agar akun dinilai tepercaya.</p>
    </div>
    <div class="bg-white border border-gray-200 rounded-2xl p-5 shadow-sm text-center">
        <div class="w-10 h-10 bg-green-50 text-green-600 rounded-xl flex items-center justify-center mx-auto text-base"><i class="fa-solid fa-wallet"></i></div>
        <h3 class="text-xs font-bold text-gray-900 mt-3">Sistem Pembayaran</h3>
        <p class="text-[11px] text-gray-500 mt-1">Informasi pencairan upah harian secara tunai maupun transfer dompet digital.</p>
    </div>
</div>

<div class="bg-white border border-gray-200 rounded-2xl p-6 shadow-sm max-w-3xl mx-auto">
    <h2 class="text-sm font-bold text-gray-900 mb-4 border-b border-gray-100 pb-3">Pertanyaan yang Sering Diajukan (FAQ)</h2>
    <div class="space-y-4 divide-y divide-gray-100">
        <div class="pt-3 first:pt-0">
            <h4 class="text-xs font-bold text-gray-800">Bagaimana cara memastikan lowongan tersebut aman?</h4>
            <p class="text-xs text-gray-600 mt-1.5 leading-relaxed">Semua profil penyedia lowongan yang memiliki tanda centang hijau telah melewati tahap verifikasi identitas resmi oleh tim kami demi menjamin keamanan transaksi kerja.</p>
        </div>
        <div class="pt-4">
            <h4 class="text-xs font-bold text-gray-800">Kapan upah harian saya dibayarkan?</h4>
            <p class="text-xs text-gray-600 mt-1.5 leading-relaxed">Pembayaran upah disesuaikan dengan kesepakatan di rincian lowongan kerja. Umumnya, upah harian dibayarkan langsung setiap sore hari setelah jam kerja selesai.</p>
        </div>
        <div class="pt-4">
            <h4 class="text-xs font-bold text-gray-800">Apakah saya bisa membatalkan lamaran yang sudah dikirim?</h4>
            <p class="text-xs text-gray-600 mt-1.5 leading-relaxed">Bisa. Selama status lamaran masih berada dalam antrean peninjauan dan belum disetujui oleh penyedia kerja, Anda dapat membatalkannya melalui menu Lamaran Saya.</p>
        </div>
    </div>
</div>

<div class="mt-8 bg-teal-900 text-white rounded-2xl p-6 text-center max-w-3xl mx-auto shadow-md">
    <h3 class="text-sm font-bold">Masih butuh bantuan atau punya kendala teknis?</h3>
    <p class="text-xs text-teal-200 mt-1">Tim Customer Support kami siap mendampingi dan melayani keluhan Anda setiap hari.</p>
    <button class="mt-4 bg-[#f4b41a] hover:bg-yellow-500 text-gray-900 font-bold px-5 py-2.5 rounded-xl text-xs transition shadow-sm">
        <i class="fa-solid fa-headset mr-1.5"></i> Hubungi Bantuan (08:00 - 20:00)
    </button>
</div>
@endsection