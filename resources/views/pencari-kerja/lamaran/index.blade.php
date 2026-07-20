@extends('layouts.app')

@section('content')
    <div class="mb-6">
        <h1 class="text-2xl font-bold text-gray-900">Lamaran Saya</h1>
        <p class="text-gray-600 text-sm">Pantau status lamaran kerja harian yang sudah kamu kirim.</p>
    </div>

    <div class="bg-white border border-gray-200 rounded-2xl shadow-sm overflow-hidden">
        <div class="border-b border-gray-200 px-6 py-4 flex space-x-6 text-xs font-bold overflow-x-auto">
            <a href="{{ route('pencari-kerja.lamaran.index') }}"
                class="pb-4 -mb-4 whitespace-nowrap {{ !$status ? 'text-primary border-b-2 border-primary' : 'text-gray-500 hover:text-primary' }}">
                Semua Lamaran ({{ $jumlah['semua'] }})
            </a>
            <a href="{{ route('pencari-kerja.lamaran.index', ['status' => 'menunggu']) }}"
                class="pb-4 -mb-4 whitespace-nowrap {{ $status === 'menunggu' ? 'text-primary border-b-2 border-primary' : 'text-gray-500 hover:text-primary' }}">
                Ditinjau ({{ $jumlah['menunggu'] }})
            </a>
            <a href="{{ route('pencari-kerja.lamaran.index', ['status' => 'diterima']) }}"
                class="pb-4 -mb-4 whitespace-nowrap {{ $status === 'diterima' ? 'text-primary border-b-2 border-primary' : 'text-gray-500 hover:text-primary' }}">
                Diterima ({{ $jumlah['diterima'] }})
            </a>
            <a href="{{ route('pencari-kerja.lamaran.index', ['status' => 'ditolak']) }}"
                class="pb-4 -mb-4 whitespace-nowrap {{ $status === 'ditolak' ? 'text-primary border-b-2 border-primary' : 'text-gray-500 hover:text-primary' }}">
                Ditolak ({{ $jumlah['ditolak'] }})
            </a>
        </div>

        <div class="divide-y divide-gray-100">
            @forelse ($lamaran as $item)
                <div class="p-6 flex flex-col md:flex-row md:items-center justify-between gap-4">
                    <div class="flex items-start space-x-4">
                        <div
                            class="w-12 h-12 bg-gray-100 rounded-xl flex items-center justify-center text-gray-600 text-base shrink-0">
                            <i class="fa-solid fa-briefcase"></i>
                        </div>
                        <div>
                            <h3 class="text-xs font-bold text-gray-900">{{ $item->lowongan->judul }}</h3>
                            <p class="text-[11px] text-gray-500 mt-0.5">{{ $item->lowongan->pemberiKerja->nama }} •
                                {{ $item->lowongan->lokasi }}</p>
                            <div class="flex items-center space-x-3 mt-2 text-[10px] text-gray-400">
                                <span><i class="fa-solid fa-money-bill-wave text-teal-600 mr-1"></i> Rp
                                    {{ number_format($item->lowongan->upah, 0, ',', '.') }}/{{ $item->lowongan->satuan_upah }}</span>
                                <span><i class="fa-solid fa-calendar-days mr-1"></i> Dikirim
                                    {{ $item->created_at->diffForHumans() }}</span>
                            </div>
                        </div>
                    </div>
                    <div class="flex items-center justify-between md:justify-end gap-4 border-t md:border-t-0 pt-3 md:pt-0">
                        @if ($item->status === 'menunggu')
                            <span
                                class="px-2.5 py-1 bg-amber-50 text-amber-700 text-[10px] font-bold rounded-lg border border-amber-100">
                                <i class="fa-solid fa-clock mr-1"></i> Sedang Ditinjau
                            </span>
                        @elseif ($item->status === 'ditolak')
                            <span
                                class="px-2.5 py-1 bg-red-50 text-red-600 text-[10px] font-bold rounded-lg border border-red-100">
                                <i class="fa-solid fa-circle-xmark mr-1"></i> Ditolak
                            </span>
                        @elseif ($item->kontrak)
                            @php
                                $labelKontrak = match ($item->kontrak->status) {
                                    'berlangsung' => ['Sedang Berlangsung', 'blue'],
                                    'selesai' => ['Pekerjaan Selesai', 'teal'],
                                    'dibayar' => ['Sudah Dibayar', 'green'],
                                    'sengketa' => ['Dalam Sengketa', 'red'],
                                    default => ['Diterima', 'green'],
                                };
                            @endphp
                            <span
                                class="px-2.5 py-1 bg-{{ $labelKontrak[1] }}-50 text-{{ $labelKontrak[1] }}-700 text-[10px] font-bold rounded-lg border border-{{ $labelKontrak[1] }}-100">
                                <i class="fa-solid fa-circle-check mr-1"></i> {{ $labelKontrak[0] }}
                            </span>
                        @endif

                        <div class="flex items-center gap-2">
                            <a href="{{ route('pencari-kerja.lamaran.show', $item) }}"
                                class="text-xs font-bold text-gray-600 border border-gray-200 px-4 py-2 rounded-xl hover:bg-gray-50 transition">Detail</a>
                            @if ($item->percakapan)
                                <a href="{{ route('pencari-kerja.pesan.show', $item->percakapan) }}"
                                    class="text-xs font-bold text-white bg-primary px-4 py-2 rounded-xl hover:bg-primary-hover transition">Hubungi</a>
                            @endif
                        </div>
                    </div>
                </div>
            @empty
                <div class="p-12 text-center">
                    <p class="text-xs text-gray-500">Belum ada lamaran di kategori ini.</p>
                    <a href="{{ route('pencari-kerja.lowongan.index') }}"
                        class="text-xs text-primary font-bold hover:underline mt-2 inline-block">Cari Lowongan Sekarang</a>
                </div>
            @endforelse
        </div>

        @if ($lamaran->hasPages())
            <div class="p-4 border-t border-gray-100">
                {{ $lamaran->links() }}
            </div>
        @endif
    </div>
@endsection
