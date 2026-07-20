@extends('layouts.app')

@section('content')
    <div class="mb-6">
        <h1 class="text-2xl font-bold text-gray-900">Pekerjaan Tersimpan</h1>
        <p class="text-gray-600 text-sm">Simpan lowongan menarik terlebih dahulu dan lamar kapan saja saat kamu siap.</p>
    </div>

    <div class="grid grid-cols-1 md:grid-cols-2 gap-6" id="gridLowonganTersimpan">
        @forelse ($tersimpan as $item)
            <div class="bg-white border border-gray-200 rounded-2xl p-6 shadow-sm flex flex-col justify-between hover:border-teal-500 transition"
                data-card-id="{{ $item->lowongan->id }}">
                <div>
                    <div class="flex justify-between items-start">
                        <div
                            class="w-10 h-10 bg-teal-50 text-primary rounded-xl flex items-center justify-center text-sm font-bold">
                            <i class="fa-solid fa-briefcase"></i>
                        </div>
                        <button type="button" title="Hapus dari tersimpan"
                            class="btn-hapus-tersimpan text-red-400 bg-red-50 hover:bg-red-100 p-2 rounded-xl text-xs transition"
                            data-id="{{ $item->lowongan->id }}">
                            <i class="fa-solid fa-bookmark"></i>
                        </button>
                    </div>
                    <div class="mt-4">
                        <h3 class="text-xs font-bold text-gray-900">{{ $item->lowongan->judul }}</h3>
                        <p class="text-[11px] text-gray-500 mt-0.5">{{ $item->lowongan->pemberiKerja->nama }} •
                            {{ $item->lowongan->lokasi }}</p>
                    </div>
                    <div class="mt-4 flex items-center space-x-4 text-[11px] text-gray-400">
                        <span><i class="fa-solid fa-money-bill-wave text-teal-600 mr-1"></i> Rp
                            {{ number_format($item->lowongan->upah, 0, ',', '.') }}/{{ $item->lowongan->satuan_upah }}</span>
                    </div>
                </div>
                <div class="mt-6 pt-4 border-t border-gray-100 flex items-center justify-between">
                    <span class="text-[10px] text-gray-400 font-medium">Disimpan
                        {{ $item->created_at->diffForHumans() }}</span>
                    <a href="{{ route('pencari-kerja.lowongan.show', $item->lowongan) }}"
                        class="bg-primary hover:bg-primary-hover text-white font-bold px-4 py-2 rounded-xl text-xs transition">
                        Lihat Detail
                    </a>
                </div>
            </div>
        @empty
            <div class="md:col-span-2 bg-white border border-gray-200 rounded-2xl p-12 text-center" id="emptyState">
                <p class="text-xs text-gray-500">Belum ada lowongan yang kamu simpan.</p>
                <a href="{{ route('pencari-kerja.lowongan.index') }}"
                    class="text-xs text-primary font-bold hover:underline mt-2 inline-block">Cari Lowongan Sekarang</a>
            </div>
        @endforelse
    </div>

    @if ($tersimpan->hasPages())
        <div class="mt-6">
            {{ $tersimpan->links() }}
        </div>
    @endif

    @push('scripts')
        <script>
            document.querySelectorAll('.btn-hapus-tersimpan').forEach(function(btn) {
                btn.addEventListener('click', function() {
                    const idLowongan = this.dataset.id;
                    const card = this.closest('[data-card-id]');

                    fetch(`/pencari-kerja/lowongan-tersimpan/${idLowongan}/hapus`, {
                            method: 'DELETE',
                            headers: {
                                'Content-Type': 'application/json',
                                'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content,
                            },
                        })
                        .then(res => res.json())
                        .then(data => {
                            if (data.sukses && card) {
                                card.remove();
                            }
                        });
                });
            });
        </script>
    @endpush
@endsection
