@extends('layouts.app')

@section('content')
    <div class="mb-6 text-center max-w-xl mx-auto">
        <h1 class="text-2xl font-bold text-gray-900">Pusat Bantuan KerjaHarian</h1>
        <p class="text-gray-600 text-sm mt-1">Punya kendala atau pertanyaan? Cari panduan dan jawaban di bawah ini.</p>
    </div>

    <div class="grid grid-cols-1 md:grid-cols-3 gap-6 mb-8">
        <div class="bg-white border border-gray-200 rounded-2xl p-5 shadow-sm text-center">
            <div class="w-10 h-10 bg-teal-50 text-primary rounded-xl flex items-center justify-center mx-auto text-base"><i
                    class="fa-solid fa-circle-info"></i></div>
            <h3 class="text-xs font-bold text-gray-900 mt-3">Panduan Melamar</h3>
            <p class="text-[11px] text-gray-500 mt-1">Langkah mudah mengajukan lamaran harian dari awal sampai diterima
                kerja.</p>
        </div>
        <div class="bg-white border border-gray-200 rounded-2xl p-5 shadow-sm text-center">
            <div class="w-10 h-10 bg-amber-50 text-amber-600 rounded-xl flex items-center justify-center mx-auto text-base">
                <i class="fa-solid fa-shield-halved"></i></div>
            <h3 class="text-xs font-bold text-gray-900 mt-3">Akun & Keamanan</h3>
            <p class="text-[11px] text-gray-500 mt-1">Cara melengkapi profil dan data diri agar akun dinilai tepercaya.</p>
        </div>
        <div class="bg-white border border-gray-200 rounded-2xl p-5 shadow-sm text-center">
            <div class="w-10 h-10 bg-green-50 text-green-600 rounded-xl flex items-center justify-center mx-auto text-base">
                <i class="fa-solid fa-wallet"></i></div>
            <h3 class="text-xs font-bold text-gray-900 mt-3">Sistem Pembayaran</h3>
            <p class="text-[11px] text-gray-500 mt-1">Informasi konfirmasi pembayaran melalui bukti transfer manual.</p>
        </div>
    </div>

    <div class="bg-white border border-gray-200 rounded-2xl p-6 shadow-sm max-w-3xl mx-auto">
        <h2 class="text-sm font-bold text-gray-900 mb-4 border-b border-gray-100 pb-3">Pertanyaan yang Sering Diajukan (FAQ)
        </h2>
        <div class="space-y-4 divide-y divide-gray-100">
            <div class="pt-3 first:pt-0">
                <h4 class="text-xs font-bold text-gray-800">Bagaimana cara melamar pekerjaan di KerjaHarian?</h4>
                <p class="text-xs text-gray-600 mt-1.5 leading-relaxed">Cari lowongan di menu "Cari Kerja", buka detail
                    lowongan yang diminati, lalu klik "Lamar Pekerjaan Ini" dan kirim pesan singkat ke pemberi kerja.</p>
            </div>
            <div class="pt-4">
                <h4 class="text-xs font-bold text-gray-800">Kapan upah harian saya dibayarkan?</h4>
                <p class="text-xs text-gray-600 mt-1.5 leading-relaxed">Pembayaran dilakukan secara transfer manual oleh
                    pemberi kerja setelah pekerjaan selesai. Anda akan diminta mengonfirmasi bukti transfer yang diunggah
                    melalui menu Kontrak.</p>
            </div>
            <div class="pt-4">
                <h4 class="text-xs font-bold text-gray-800">Apakah saya bisa membatalkan lamaran yang sudah dikirim?</h4>
                <p class="text-xs text-gray-600 mt-1.5 leading-relaxed">Saat ini fitur pembatalan lamaran belum tersedia.
                    Jika Anda salah melamar, silakan hubungi pemberi kerja melalui menu Pesan setelah lamaran diterima.</p>
            </div>
            <div class="pt-4">
                <h4 class="text-xs font-bold text-gray-800">Bagaimana cara melengkapi data rekening untuk pembayaran?</h4>
                <p class="text-xs text-gray-600 mt-1.5 leading-relaxed">Buka menu Profil Saya, isi bagian Data Rekening
                    (nama bank, nomor rekening, dan nama pemilik), lalu simpan perubahan.</p>
            </div>
        </div>
    </div>

    <div class="mt-8 bg-teal-900 text-white rounded-2xl p-6 text-center max-w-3xl mx-auto shadow-md">
        <h3 class="text-sm font-bold">Masih butuh bantuan?</h3>
        <p class="text-xs text-teal-200 mt-1">Hubungi tim kami melalui email untuk kendala yang belum terjawab di atas.</p>
        <a href="mailto:support@kerjaharian.test"
            class="mt-4 inline-block bg-secondary hover:bg-yellow-500 text-gray-900 font-bold px-5 py-2.5 rounded-xl text-xs transition shadow-sm">
            <i class="fa-solid fa-envelope mr-1.5"></i> support@kerjaharian.test
        </a>
    </div>
@endsection
