@extends('layouts.app')

@section('content')
    <div class="mb-6">
        <h1 class="text-2xl font-bold text-gray-900">Selamat Datang, {{ $user->nama }}!</h1>
        <p class="text-gray-600 text-sm">Pantau status lamaran kerja harianmu dan temukan proyek baru hari ini.</p>
    </div>

    <div class="grid grid-cols-1 md:grid-cols-3 gap-6 mb-8">
        <div class="bg-white border border-gray-200 rounded-2xl p-5 shadow-sm flex items-center justify-between">
            <div>
                <span class="text-gray-400 text-xs font-medium block">Lamaran Aktif</span>
                <span class="text-2xl font-extrabold text-gray-900 mt-1 block">{{ $statistik['aktif'] }}</span>
            </div>
            <div class="w-12 h-12 bg-teal-50 text-primary rounded-xl flex items-center justify-center text-lg">
                <i class="fa-solid fa-file-invoice"></i>
            </div>
        </div>

        <div class="bg-white border border-gray-200 rounded-2xl p-5 shadow-sm flex items-center justify-between">
            <div>
                <span class="text-gray-400 text-xs font-medium block">Diterima</span>
                <span class="text-2xl font-extrabold text-green-600 mt-1 block">{{ $statistik['diterima'] }}</span>
            </div>
            <div class="w-12 h-12 bg-green-50 text-green-600 rounded-xl flex items-center justify-center text-lg">
                <i class="fa-solid fa-circle-check"></i>
            </div>
        </div>

        <div class="bg-white border border-gray-200 rounded-2xl p-5 shadow-sm flex items-center justify-between">
            <div>
                <span class="text-gray-400 text-xs font-medium block">Ditolak</span>
                <span class="text-2xl font-extrabold text-red-500 mt-1 block">{{ $statistik['ditolak'] }}</span>
            </div>
            <div class="w-12 h-12 bg-red-50 text-red-500 rounded-xl flex items-center justify-center text-lg">
                <i class="fa-solid fa-circle-xmark"></i>
            </div>
        </div>
    </div>

    <div class="grid grid-cols-1 lg:grid-cols-3 gap-6">
        <div class="lg:col-span-2 space-y-6">
            <div class="bg-white border border-gray-200 rounded-2xl p-6 shadow-sm">
                <div class="flex justify-between items-center mb-4">
                    <h3 class="text-sm font-bold text-gray-900">Rekomendasi Kerja Harian</h3>
                    <a href="{{ route('pencari-kerja.lowongan.index') }}"
                        class="text-xs text-primary font-bold hover:underline">Lihat Semua</a>
                </div>

                <div class="space-y-4">
                    @forelse ($rekomendasi as $lowongan)
                        <div
                            class="p-4 border border-gray-100 rounded-xl hover:border-teal-500 transition flex justify-between items-start">
                            <div class="flex space-x-3">
                                <div
                                    class="w-10 h-10 bg-gray-100 text-gray-700 rounded-xl flex items-center justify-center font-bold text-sm">
                                    <i class="fa-solid fa-briefcase"></i>
                                </div>
                                <div>
                                    <h4 class="text-xs font-bold text-gray-900">{{ $lowongan->judul }}</h4>
                                    <p class="text-[11px] text-gray-500 mt-0.5">
                                        {{ $lowongan->nama_perusahaan ?? 'Perorangan' }} • {{ $lowongan->lokasi }}</p>
                                    <div class="flex items-center space-x-3 mt-2 text-[10px] text-gray-400">
                                        <span><i class="fa-solid fa-money-bill-wave text-teal-600 mr-1"></i> Rp
                                            {{ number_format($lowongan->upah, 0, ',', '.') }}/{{ $lowongan->satuan_upah }}</span>
                                    </div>
                                </div>
                            </div>
                            <a href="{{ route('pencari-kerja.lowongan.show', $lowongan) }}"
                                class="text-xs font-bold text-primary bg-teal-50 px-3 py-1.5 rounded-lg hover:bg-primary hover:text-white transition">Detail</a>
                        </div>
                    @empty
                        <p class="text-xs text-gray-500 text-center py-8">
                            Belum ada rekomendasi lowongan di sekitar lokasi Anda. Coba
                            <a href="{{ route('pencari-kerja.lowongan.index') }}"
                                class="text-primary font-bold hover:underline">cari lowongan</a> secara manual.
                        </p>
                    @endforelse
                </div>
            </div>
        </div>

        <div class="space-y-6">
            <div class="bg-white border border-gray-200 rounded-2xl p-6 shadow-sm">
                <h3 class="text-sm font-bold text-gray-900 mb-4">Lengkapi Profil Anda</h3>
                <div class="w-full bg-gray-100 rounded-full h-2 mb-4">
                    <div class="bg-primary h-2 rounded-full" style="width: {{ $user->kelengkapan_profil }}%"></div>
                </div>
                <p class="text-[11px] text-gray-500 leading-relaxed mb-4">
                    Profil Anda sudah {{ $user->kelengkapan_profil }}% lengkap.
                    @if ($user->kelengkapan_profil < 100)
                        Lengkapi data diri dan rekening Anda agar proses lamaran dan pembayaran berjalan lancar.
                    @else
                        Profil Anda sudah lengkap, siap melamar pekerjaan!
                    @endif
                </p>
                <a href="{{ route('pencari-kerja.profil.edit') }}"
                    class="w-full block text-center bg-gray-50 hover:bg-gray-100 text-gray-700 font-bold py-2.5 rounded-xl text-xs border border-gray-200 transition">
                    Edit Profil Saya
                </a>
            </div>
        </div>
    </div>
@endsection
