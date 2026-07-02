@extends('layouts.app')

@section('content')
<div class="mb-6">
    <h1 class="text-2xl font-bold text-gray-900">Profil Saya</h1>
    <p class="text-gray-600 text-sm">Kelola informasi profil, keahlian, dan dokumen penunjang lamaranmu.</p>
</div>

<div class="grid grid-cols-1 lg:grid-cols-3 gap-6">
    <div class="bg-white border border-gray-200 rounded-2xl p-6 shadow-sm flex flex-col items-center text-center h-fit">
        <div class="w-24 h-24 rounded-full bg-gray-200 flex items-center justify-center text-3xl font-bold text-gray-600 shadow-inner relative">
            A
            <button class="absolute bottom-0 right-0 bg-[#007A87] text-white p-2 rounded-full text-xs shadow-md hover:bg-teal-700 transition">
                <i class="fa-solid fa-camera"></i>
            </button>
        </div>
        <h2 class="text-base font-bold text-gray-900 mt-4">Andi Perkasa</h2>
        <p class="text-xs text-gray-500 mt-0.5">Tukang Bangunan & Kebun</p>
        <div class="mt-3 flex items-center space-x-1.5 bg-green-50 text-green-700 px-2.5 py-1 rounded-full text-[10px] font-bold">
            <i class="fa-solid fa-shield-check"></i>
            <span>Akun Terverifikasi</span>
        </div>
        <div class="w-full border-t border-gray-100 mt-6 pt-4 text-left space-y-3">
            <div>
                <span class="text-[10px] text-gray-400 block uppercase tracking-wider font-bold">Email</span>
                <span class="text-xs text-gray-700 font-medium">andi.perkasa@example.com</span>
            </div>
            <div>
                <span class="text-[10px] text-gray-400 block uppercase tracking-wider font-bold">Nomor Telepon</span>
                <span class="text-xs text-gray-700 font-medium">0812-3456-7890</span>
            </div>
            <div>
                <span class="text-[10px] text-gray-400 block uppercase tracking-wider font-bold">Lokasi</span>
                <span class="text-xs text-gray-700 font-medium">Cimahi Tengah, Kota Cimahi</span>
            </div>
        </div>
    </div>

    <div class="lg:col-span-2 space-y-6">
        <div class="bg-white border border-gray-200 rounded-2xl p-6 shadow-sm">
            <div class="flex justify-between items-center mb-4">
                <h3 class="text-sm font-bold text-gray-900">Tentang Saya</h3>
                <button class="text-xs font-bold text-[#007A87] hover:underline">Edit</button>
            </div>
            <p class="text-xs text-gray-600 leading-relaxed">
                Saya adalah pekerja harian lepas yang berpengalaman selama lebih dari 3 tahun di bidang pertukangan kayu, pengecatan dinding rumah, dan perawatan taman. Pekerja keras, disiplin, jujur, serta selalu mengutamakan kerapihan hasil kerja demi kepuasan pemilik rumah.
            </p>
        </div>

        <div class="bg-white border border-gray-200 rounded-2xl p-6 shadow-sm">
            <div class="flex justify-between items-center mb-4">
                <h3 class="text-sm font-bold text-gray-900">Keahlian Utama</h3>
                <button class="text-xs font-bold text-[#007A87] hover:underline">Tambah</button>
            </div>
            <div class="flex flex-wrap gap-2">
                <span class="px-3 py-1.5 bg-teal-50 border border-teal-100 text-[#007A87] text-xs font-bold rounded-xl flex items-center space-x-1.5">
                    <span>Pertukangan Kayu</span>
                </span>
                <span class="px-3 py-1.5 bg-teal-50 border border-teal-100 text-[#007A87] text-xs font-bold rounded-xl flex items-center space-x-1.5">
                    <span>Pengecatan Rumah</span>
                </span>
                <span class="px-3 py-1.5 bg-teal-50 border border-teal-100 text-[#007A87] text-xs font-bold rounded-xl flex items-center space-x-1.5">
                    <span>Instalasi Listrik Ringan</span>
                </span>
                <span class="px-3 py-1.5 bg-teal-50 border border-teal-100 text-[#007A87] text-xs font-bold rounded-xl flex items-center space-x-1.5">
                    <span>Perawatan Taman</span>
                </span>
            </div>
        </div>

        <div class="bg-white border border-gray-200 rounded-2xl p-6 shadow-sm">
            <div class="flex justify-between items-center mb-4">
                <h3 class="text-sm font-bold text-gray-900">Dokumen Pendukung</h3>
                <button class="text-xs font-bold text-[#007A87] hover:underline">Unggah Baru</button>
            </div>
            <div class="space-y-3">
                <div class="p-3 border border-gray-100 rounded-xl flex justify-between items-center bg-gray-50">
                    <div class="flex items-center space-x-3">
                        <div class="text-red-500 text-lg"><i class="fa-solid fa-file-pdf"></i></div>
                        <div>
                            <h4 class="text-xs font-bold text-gray-800">KTP_Andi_Perkasa.pdf</h4>
                            <p class="text-[10px] text-gray-400 mt-0.5">Terverifikasi • 1.2 MB</p>
                        </div>
                    </div>
                    <button class="text-gray-400 hover:text-gray-600"><i class="fa-solid fa-ellipsis-vertical"></i></button>
                </div>
                <div class="p-3 border border-gray-100 rounded-xl flex justify-between items-center bg-gray-50">
                    <div class="flex items-center space-x-3">
                        <div class="text-blue-500 text-lg"><i class="fa-solid fa-file-word"></i></div>
                        <div>
                            <h4 class="text-xs font-bold text-gray-800">Sertifikat_Pelatihan_Konstruksi.docx</h4>
                            <p class="text-[10px] text-gray-400 mt-0.5">2.4 MB</p>
                        </div>
                    </div>
                    <button class="text-gray-400 hover:text-gray-600"><i class="fa-solid fa-ellipsis-vertical"></i></button>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection