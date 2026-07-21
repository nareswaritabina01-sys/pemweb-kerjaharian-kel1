@extends('layouts.app')

@section('title', 'Dashboard')

@section('content')
    <div class="max-w-7xl mx-auto">
        <div class="mb-6">
            <h1 class="text-2xl font-bold text-gray-900">Dashboard</h1>
            <p class="text-gray-600 text-sm">Ringkasan aktivitas lowongan dan pelamar Anda.</p>
        </div>

        {{-- Statistik --}}
        <div class="grid grid-cols-2 md:grid-cols-4 gap-4 mb-8">
            <div class="bg-white rounded-2xl border border-gray-100 shadow-sm p-5">
                <div class="w-10 h-10 rounded-full bg-teal-50 flex items-center justify-center mb-3">
                    <i class="fa-solid fa-briefcase text-primary"></i>
                </div>
                <p class="text-2xl font-bold text-gray-900">{{ $total_lowongan_aktif }}</p>
                <p class="text-[11px] text-gray-500">Lowongan Aktif</p>
            </div>

            <div class="bg-white rounded-2xl border border-gray-100 shadow-sm p-5">
                <div class="w-10 h-10 rounded-full bg-yellow-50 flex items-center justify-center mb-3">
                    <i class="fa-solid fa-users text-secondary"></i>
                </div>
                <p class="text-2xl font-bold text-gray-900">{{ $total_pelamar }}</p>
                <p class="text-[11px] text-gray-500">Total Pelamar</p>
            </div>

            <div class="bg-white rounded-2xl border border-gray-100 shadow-sm p-5">
                <div class="w-10 h-10 rounded-full bg-green-50 flex items-center justify-center mb-3">
                    <i class="fa-solid fa-file-signature text-green-600"></i>
                </div>
                <p class="text-2xl font-bold text-gray-900">{{ $kontrak_aktif }}</p>
                <p class="text-[11px] text-gray-500">Kontrak Aktif</p>
            </div>

            <div class="bg-white rounded-2xl border border-gray-100 shadow-sm p-5">
                <div class="w-10 h-10 rounded-full bg-red-50 flex items-center justify-center mb-3">
                    <i class="fa-solid fa-money-bill-wave text-red-500"></i>
                </div>
                <p class="text-2xl font-bold text-gray-900">{{ $menunggu_pembayaran }}</p>
                <p class="text-[11px] text-gray-500">Menunggu Pembayaran</p>
            </div>
        </div>

        <div class="grid grid-cols-1 lg:grid-cols-3 gap-6">
            {{-- Pelamar Terbaru --}}
            <div class="lg:col-span-2 bg-white rounded-2xl border border-gray-100 shadow-sm p-6">
                <h2 class="font-bold text-gray-900 text-sm mb-4">
                    <i class="fa-solid fa-user-clock text-primary mr-1"></i> Pelamar Terbaru
                </h2>

                @forelse ($pelamar_terbaru as $lamaran)
                    <div class="flex items-center justify-between border-b border-gray-100 py-3 last:border-0">
                        <div class="flex items-center gap-3">
                            <img src="{{ $lamaran->pencariKerja->foto_profil_url }}"
                                alt="{{ $lamaran->pencariKerja->nama }}"
                                class="w-10 h-10 rounded-full object-cover border border-gray-100">
                            <div>
                                <p class="font-semibold text-gray-800 text-sm">{{ $lamaran->pencariKerja->nama }}</p>
                                <p class="text-[11px] text-gray-400">
                                    Melamar <span class="font-medium text-gray-600">{{ $lamaran->lowongan->judul }}</span>
                                    &middot; {{ $lamaran->created_at->diffForHumans() }}
                                </p>
                            </div>
                        </div>
                        <a href="{{ route('pemberi-kerja.lowongan.show', $lamaran->id_lowongan) }}"
                            class="text-[11px] font-bold px-3 py-1 rounded-full
                            @class([
                                'bg-yellow-100 text-yellow-700' => $lamaran->status === 'menunggu',
                                'bg-green-100 text-green-700' => $lamaran->status === 'diterima',
                                'bg-red-100 text-red-700' => $lamaran->status === 'ditolak',
                            ])">
                            {{ ucfirst($lamaran->status) }}
                        </a>
                    </div>
                @empty
                    <div class="text-center py-10 text-gray-400">
                        <i class="fa-solid fa-inbox text-2xl mb-2"></i>
                        <p class="text-sm">Belum ada pelamar masuk.</p>
                    </div>
                @endforelse
            </div>

            {{-- Aksi Cepat --}}
            <div class="bg-white rounded-2xl border border-gray-100 shadow-sm p-6">
                <h2 class="font-bold text-gray-900 text-sm mb-4">
                    <i class="fa-solid fa-bolt text-primary mr-1"></i> Aksi Cepat
                </h2>

                <div class="space-y-3">
                    <a href="{{ route('pemberi-kerja.lowongan.create') }}"
                        class="flex items-center gap-3 bg-teal-50 hover:bg-teal-100 text-primary font-semibold text-sm px-4 py-3 rounded-xl transition">
                        <i class="fa-solid fa-plus"></i> Buat Lowongan Baru
                    </a>
                    <a href="{{ route('pemberi-kerja.lowongan.index') }}"
                        class="flex items-center gap-3 bg-gray-50 hover:bg-gray-100 text-gray-700 font-semibold text-sm px-4 py-3 rounded-xl transition">
                        <i class="fa-solid fa-list"></i> Kelola Lowongan Saya
                    </a>
                </div>

                @if ($menunggu_pembayaran > 0)
                    <div class="mt-4 bg-red-50 border border-red-100 rounded-xl p-4">
                        <p class="text-xs text-red-700 font-semibold mb-1">
                            <i class="fa-solid fa-triangle-exclamation mr-1"></i> Ada {{ $menunggu_pembayaran }} kontrak
                            menunggu pembayaran
                        </p>
                        <p class="text-[11px] text-red-500">Fitur upload bukti transfer akan segera tersedia.</p>
                    </div>
                @endif
            </div>
        </div>
    </div>
@endsection
