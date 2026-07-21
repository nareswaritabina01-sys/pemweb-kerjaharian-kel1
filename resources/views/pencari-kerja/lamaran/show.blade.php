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

            @if (in_array($lamaran->kontrak->status, ['selesai', 'dibayar']))
                <div class="mt-6 border-t border-gray-100 pt-6 space-y-3">
                    @if ($lamaran->kontrak->status === 'selesai')
                        <form action="{{ route('pencari-kerja.kontrak.dibayar', $lamaran->kontrak) }}" method="POST">
                            @csrf
                            <button type="submit"
                                class="inline-block bg-primary hover:bg-primary-hover text-white font-bold px-5 py-2.5 rounded-xl text-xs transition">
                                <i class="fa-solid fa-check-circle mr-1"></i> Konfirmasi Pembayaran
                            </button>
                        </form>
                    @endif

                    <form action="{{ route('pencari-kerja.kontrak.sengketa', $lamaran->kontrak) }}" method="POST">
                        @csrf
                        <button type="button" onclick="konfirmasiSengketa(this)"
                            class="inline-block bg-red-600 hover:bg-red-700 text-white font-bold px-5 py-2.5 rounded-xl text-xs transition">
                            <i class="fa-solid fa-gavel mr-1"></i> Ajukan Sengketa
                        </button>
                    </form>
                </div>
            @endif
        @endif

        @if ($lamaran->percakapan)
            <div class="mt-6">
                <a href="{{ route('pencari-kerja.pesan.show', $lamaran->percakapan) }}"
                    class="inline-block bg-primary hover:bg-primary-hover text-white font-bold px-5 py-2.5 rounded-xl text-xs transition">
                    <i class="fa-solid fa-comment-dots mr-1"></i> Hubungi Pemberi Kerja
                </a>
            </div>
        @endif

        @if ($lamaran->status === 'menunggu')
            <div class="mt-6 border-t border-gray-100 pt-6">
                <form action="{{ route('pencari-kerja.lamaran.batalkan', $lamaran) }}" method="POST"
                    id="form-batal-{{ $lamaran->id }}">
                    @csrf
                    @method('DELETE')
                    <button type="button" onclick="batalkanLamaran({{ $lamaran->id }})"
                        class="inline-block bg-white border border-red-200 text-red-600 font-bold px-5 py-2.5 rounded-xl text-xs hover:bg-red-50 transition">
                        <i class="fa-solid fa-xmark mr-1"></i> Batalkan Lamaran
                    </button>
                </form>
            </div>
        @endif
    </div>

    @push('scripts')
        <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
        <script>
            function batalkanLamaran(id) {
                Swal.fire({
                    title: 'Batalkan lamaran ini?',
                    text: 'Tindakan ini tidak dapat dibatalkan.',
                    icon: 'warning',
                    showCancelButton: true,
                    confirmButtonColor: '#EF4444',
                    cancelButtonColor: '#6B7280',
                    confirmButtonText: 'Ya, Batalkan',
                    cancelButtonText: 'Batal',
                }).then((result) => {
                    if (result.isConfirmed) {
                        document.getElementById(`form-batal-${id}`).submit();
                    }
                });
            }

            function konfirmasiSengketa(tombol) {
                Swal.fire({
                    title: 'Ajukan sengketa kontrak?',
                    text: 'Anda akan mengajukan sengketa. Admin akan meninjau kasus ini.',
                    icon: 'warning',
                    showCancelButton: true,
                    confirmButtonColor: '#EF4444',
                    cancelButtonColor: '#6B7280',
                    confirmButtonText: 'Ya, Ajukan Sengketa',
                    cancelButtonText: 'Batal',
                }).then((result) => {
                    if (result.isConfirmed) {
                        tombol.closest('form').submit();
                    }
                });
            }
        </script>
    @endpush
@endsection
