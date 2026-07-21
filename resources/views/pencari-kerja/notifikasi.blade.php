@extends('layouts.app')

@section('content')
    <div class="mb-6">
        <h1 class="text-2xl font-bold text-gray-900">Notifikasi</h1>
        <p class="text-gray-600 text-sm">Informasi terbaru mengenai pembaruan status lamaran dan pesan masuk kamu.</p>
    </div>

    <div class="bg-white border border-gray-200 rounded-2xl shadow-sm overflow-hidden">
        @forelse ($notifikasi as $item)
            <a href="{{ $item->link }}"
                class="flex items-start gap-4 p-5 border-b border-gray-100 last:border-b-0 hover:bg-gray-50 transition">
                <div
                    class="w-10 h-10 rounded-xl flex items-center justify-center shrink-0
                    {{ $item->tipe === 'pesan' ? 'bg-teal-50 text-primary' : ($item->status === 'diterima' ? 'bg-green-50 text-green-600' : 'bg-red-50 text-red-600') }}">
                    <i
                        class="fa-solid {{ $item->tipe === 'pesan' ? 'fa-comment-dots' : ($item->status === 'diterima' ? 'fa-circle-check' : 'fa-circle-xmark') }}"></i>
                </div>
                <div class="flex-1 min-w-0">
                    <p class="text-xs font-bold text-gray-900">{{ $item->judul }}</p>
                    <p class="text-[11px] text-gray-500 mt-0.5 truncate">{{ $item->pesan }}</p>
                    <p class="text-[10px] text-gray-400 mt-1">{{ $item->waktu->diffForHumans() }}</p>
                </div>
            </a>
        @empty
            <div class="p-12 text-center">
                <i class="fa-solid fa-bell-slash text-3xl text-gray-300"></i>
                <p class="text-xs text-gray-500 mt-3">Belum ada notifikasi.</p>
                <p class="text-[11px] text-gray-400 mt-1">Pembaruan lamaran dan pesan baru akan muncul di sini.</p>
            </div>
        @endforelse
    </div>
@endsection
