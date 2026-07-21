@extends('layouts.app')

@section('title', 'Kontrak Saya')

@section('content')
    <div class="max-w-6xl mx-auto">
        <div class="mb-6">
            <h1 class="text-2xl font-bold text-gray-900">Kontrak Kerja</h1>
            <p class="text-gray-600 text-sm">Kelola kontrak dan pembayaran untuk pekerja yang Anda terima.</p>
        </div>

        {{-- Filter Status --}}
        <div class="flex gap-2 mb-6 flex-wrap">
            <a href="{{ route('pemberi-kerja.kontrak.index') }}"
                class="px-4 py-2 rounded-full border text-xs font-semibold transition
                {{ !$status ? 'bg-primary text-white border-primary' : 'bg-white text-gray-600 border-gray-200 hover:border-primary hover:text-primary' }}">
                Semua
            </a>
            <a href="{{ route('pemberi-kerja.kontrak.index', ['status' => 'berlangsung']) }}"
                class="px-4 py-2 rounded-full border text-xs font-semibold transition
                {{ $status === 'berlangsung' ? 'bg-primary text-white border-primary' : 'bg-white text-gray-600 border-gray-200 hover:border-primary hover:text-primary' }}">
                Berlangsung
            </a>
            <a href="{{ route('pemberi-kerja.kontrak.index', ['status' => 'selesai']) }}"
                class="px-4 py-2 rounded-full border text-xs font-semibold transition
                {{ $status === 'selesai' ? 'bg-primary text-white border-primary' : 'bg-white text-gray-600 border-gray-200 hover:border-primary hover:text-primary' }}">
                Selesai
            </a>
            <a href="{{ route('pemberi-kerja.kontrak.index', ['status' => 'dibayar']) }}"
                class="px-4 py-2 rounded-full border text-xs font-semibold transition
                {{ $status === 'dibayar' ? 'bg-primary text-white border-primary' : 'bg-white text-gray-600 border-gray-200 hover:border-primary hover:text-primary' }}">
                Dibayar
            </a>
            <a href="{{ route('pemberi-kerja.kontrak.index', ['status' => 'sengketa']) }}"
                class="px-4 py-2 rounded-full border text-xs font-semibold transition
                {{ $status === 'sengketa' ? 'bg-primary text-white border-primary' : 'bg-white text-gray-600 border-gray-200 hover:border-primary hover:text-primary' }}">
                Sengketa
            </a>
        </div>

        {{-- List Kontrak --}}
        <div class="space-y-4">
            @forelse ($kontrak as $item)
                <div class="bg-white rounded-2xl border border-gray-100 shadow-sm p-5 flex items-center justify-between">
                    <div class="flex items-center gap-4">
                        <img src="{{ $item->lamaran->pencariKerja->foto_profil_url }}"
                            alt="{{ $item->lamaran->pencariKerja->nama }}"
                            class="w-12 h-12 rounded-full object-cover border border-gray-100">
                        <div>
                            <p class="font-bold text-gray-900 text-sm">{{ $item->lamaran->pencariKerja->nama }}</p>
                            <p class="text-[11px] text-gray-500">{{ $item->lamaran->lowongan->judul }}</p>
                            <p class="text-[11px] text-gray-400">Dibuat {{ $item->created_at->diffForHumans() }}</p>
                        </div>
                    </div>
                    <div class="flex items-center gap-4">
                        <span
                            class="text-[10px] font-bold px-3 py-1 rounded-full
                            @class([
                                'bg-blue-100 text-blue-700' => $item->status === 'berlangsung',
                                'bg-yellow-100 text-yellow-700' => $item->status === 'selesai',
                                'bg-green-100 text-green-700' => $item->status === 'dibayar',
                                'bg-red-100 text-red-700' => $item->status === 'sengketa',
                            ])">
                            {{ ucfirst($item->status) }}
                        </span>
                        <a href="{{ route('pemberi-kerja.kontrak.show', $item->id) }}"
                            class="bg-gray-100 hover:bg-gray-200 text-gray-700 font-bold px-4 py-2 rounded-full text-xs transition">
                            Detail
                        </a>
                    </div>
                </div>
            @empty
                <div class="text-center py-16 text-gray-400 bg-white rounded-2xl border border-gray-100">
                    <i class="fa-solid fa-file-signature text-3xl mb-3"></i>
                    <p class="text-sm">Belum ada kontrak kerja.</p>
                </div>
            @endforelse
        </div>

        <div class="mt-8">
            {{ $kontrak->links() }}
        </div>
    </div>
@endsection
