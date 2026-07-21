@extends('layouts.app')

@section('content')
    <div class="mb-6">
        <h1 class="text-2xl font-bold text-gray-900">Notifikasi</h1>
        <p class="text-gray-600 text-sm">Informasi terbaru mengenai kontrak dan pesan masuk dari pencari kerja.</p>
    </div>

    <div class="bg-white border border-gray-200 rounded-2xl shadow-sm overflow-hidden">
        @forelse ($notifikasi as $item)
            <div class="flex items-start gap-4 p-5 border-b border-gray-100 last:border-b-0 hover:bg-gray-50 transition">
                <div
                    class="w-10 h-10 rounded-xl flex items-center justify-center shrink-0
                    @if ($item->tipe === 'pesan') bg-teal-50 text-primary
                    @elseif ($item->status === 'diterima' || $item->status === 'dibayar') bg-green-50 text-green-600
                    @elseif ($item->status === 'selesai') bg-yellow-50 text-yellow-700
                    @elseif ($item->status === 'sengketa') bg-red-50 text-red-600
                    @else bg-gray-100 text-gray-500 @endif">
                    <i
                        class="fa-solid @if ($item->tipe === 'pesan') fa-comment-dots
                        @elseif ($item->status === 'diterima' || $item->status === 'dibayar') fa-circle-check
                        @elseif ($item->status === 'selesai') fa-hourglass-half
                        @elseif ($item->status === 'sengketa') fa-gavel
                        @else fa-bell @endif"></i>
                </div>
                <div class="flex-1 min-w-0">
                    <p class="text-xs font-bold text-gray-900">{{ $item->judul }}</p>
                    <p class="text-[11px] text-gray-500 mt-0.5 truncate">{{ $item->pesan }}</p>
                    <p class="text-[10px] text-gray-400 mt-1">{{ $item->waktu->diffForHumans() }}</p>
                </div>
                <div class="ml-4 flex-shrink-0">
                    @if (empty($item->read_at))
                        <form action="{{ route('pemberi-kerja.notifikasi.baca', $item->id) }}" method="POST">
                            @csrf
                            <button type="submit" class="text-xs text-primary font-semibold">Tandai Dibaca</button>
                        </form>
                    @else
                        <span class="text-[10px] text-gray-400">Sudah dibaca</span>
                    @endif
                </div>
            </div>
        @empty
            <div class="p-12 text-center">
                <i class="fa-solid fa-bell-slash text-3xl text-gray-300"></i>
                <p class="text-xs text-gray-500 mt-3">Belum ada notifikasi.</p>
                <p class="text-[11px] text-gray-400 mt-1">Pembaruan kontrak dan pesan baru akan muncul di sini.</p>
            </div>
        @endforelse
    </div>
@endsection
