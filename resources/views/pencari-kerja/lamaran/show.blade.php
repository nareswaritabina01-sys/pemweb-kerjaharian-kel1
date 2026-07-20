@extends('layouts.app')

@section('content')
    <div class="mb-6">
        <a href="{{ route('pencari-kerja.lamaran.index') }}"
            class="text-xs font-bold text-primary hover:underline flex items-center space-x-1">
            <span>← Kembali ke Lamaran Saya</span>
        </a>
    </div>

    <div class="bg-white p-6 rounded-2xl shadow-sm border border-gray-200">
        <div class="flex justify-between items-start mb-6 border-b border-gray-100 pb-6">
            <div>
                <h1 class="text-xl font-bold text-gray-900">{{ $lamaran->lowongan->judul }}</h1>
                <p class="text-gray-500 text-sm mt-1">{{ $lamaran->lowongan->pemberiKerja->nama }} •
                    {{ $lamaran->lowongan->lokasi }}</p>
                <p class="text-xs text-gray-400 mt-2">Dikirim pada {{ $lamaran->created_at->translatedFormat('d M Y, H:i') }}
                </p>
            </div>
            <span
                class="px-3 py-1.5 text-xs font-bold rounded-full
            @if ($lamaran->status === 'menunggu') bg-amber-50 text-amber-700
            @elseif ($lamaran->status === 'ditolak') bg-red-50 text-red-600
            @else bg-green-50 text-green-700 @endif">
                {{ ucfirst($lamaran->status) }}
            </span>
        </div>

        <div class="grid grid-cols-1 md:grid-cols-2 gap-6 text-sm">
            <div>
                <p class="text-gray-400 text-xs font-bold uppercase tracking-wider mb-1">Pesan Anda ke Pemberi Kerja</p>
                <p class="text-gray-800">{{ $lamaran->pesan ?: 'Tidak ada pesan disertakan.' }}</p>
            </div>
            <div>
                <p class="text-gray-400 text-xs font-bold uppercase tracking-wider mb-1">Upah</p>
                <p class="text-gray-800 font-bold">Rp {{ number_format($lamaran->lowongan->upah, 0, ',', '.') }} /
                    {{ $lamaran->lowongan->satuan_upah }}</p>
            </div>
        </div>

        @if ($lamaran->kontrak)
            <div class="mt-8 border-t border-gray-100 pt-6">
                <h3 class="font-bold text-sm mb-4">Detail Kontrak</h3>
                <div class="bg-gray-50 rounded-xl p-4 space-y-3 text-xs">
                    <div class="flex justify-between">
                        <span class="text-gray-500">Status Kontrak</span>
                        <span class="font-bold text-gray-800">{{ ucfirst($lamaran->kontrak->status) }}</span>
                    </div>
                    @if ($lamaran->kontrak->selesai_pada)
                        <div class="flex justify-between">
                            <span class="text-gray-500">Selesai Pada</span>
                            <span
                                class="font-bold text-gray-800">{{ $lamaran->kontrak->selesai_pada->translatedFormat('d M Y, H:i') }}</span>
                        </div>
                    @endif
                    @if ($lamaran->kontrak->dibayar_pada)
                        <div class="flex justify-between">
                            <span class="text-gray-500">Dibayar Pada</span>
                            <span
                                class="font-bold text-gray-800">{{ $lamaran->kontrak->dibayar_pada->translatedFormat('d M Y, H:i') }}</span>
                        </div>
                    @endif
                </div>
            </div>
        @endif

        @if ($lamaran->percakapan)
            <div class="mt-6">
                <a href="{{ route('pencari-kerja.pesan.show', $lamaran->percakapan) }}"
                    class="inline-block bg-primary hover:bg-primary-hover text-white font-bold px-5 py-2.5 rounded-xl text-xs transition">
                    <i class="fa-solid fa-comment-dots mr-1"></i> Hubungi Pemberi Kerja
                </a>
            </div>
        @endif
    </div>
@endsection
