@extends('layouts.app')

@section('title', 'Detail Kontrak')

@section('content')
    <div class="max-w-3xl mx-auto">
        <div class="mb-6">
            <a href="{{ route('pemberi-kerja.kontrak.index') }}"
                class="inline-flex items-center gap-2 text-sm text-gray-500 hover:text-primary mb-3 transition">
                <i class="fa-solid fa-arrow-left"></i>
                <span>Kembali</span>
            </a>
            <h1 class="text-2xl font-bold text-gray-900">Detail Kontrak</h1>
            <p class="text-gray-600 text-sm">{{ $kontrak->lamaran->lowongan->judul }}</p>
        </div>

        {{-- Info Pekerja --}}
        <div class="bg-white rounded-2xl border border-gray-100 shadow-sm p-6 mb-6">
            <div class="flex items-center justify-between mb-4">
                <div class="flex items-center gap-3">
                    <img src="{{ $kontrak->lamaran->pencariKerja->foto_profil_url }}"
                        alt="{{ $kontrak->lamaran->pencariKerja->nama }}"
                        class="w-12 h-12 rounded-full object-cover border border-gray-100">
                    <div>
                        <p class="font-bold text-gray-900 text-sm">{{ $kontrak->lamaran->pencariKerja->nama }}</p>
                        <p class="text-[11px] text-gray-400">{{ $kontrak->lamaran->pencariKerja->no_telepon ?? '-' }}</p>
                    </div>
                </div>
                <span class="text-[10px] font-bold px-3 py-1 rounded-full
                    @class([
                        'bg-blue-100 text-blue-700' => $kontrak->status === 'berlangsung',
                        'bg-yellow-100 text-yellow-700' => $kontrak->status === 'selesai',
                        'bg-green-100 text-green-700' => $kontrak->status === 'dibayar',
                        'bg-red-100 text-red-700' => $kontrak->status === 'sengketa',
                    ])">
                    {{ ucfirst($kontrak->status) }}
                </span>
            </div>

            <div class="grid grid-cols-2 gap-4 text-sm border-t border-gray-100 pt-4">
                <div>
                    <p class="text-[11px] text-gray-400 mb-1">Upah</p>
                    <p class="font-bold text-primary">Rp {{ number_format($kontrak->lamaran->lowongan->upah, 0, ',', '.') }}
                        / {{ $kontrak->lamaran->lowongan->satuan_upah }}</p>
                </div>
                <div>
                    <p class="text-[11px] text-gray-400 mb-1">Tanggal Diterima</p>
                    <p class="font-semibold text-gray-800">{{ $kontrak->created_at->translatedFormat('d F Y') }}</p>
                </div>
                @if ($kontrak->selesai_pada)
                    <div>
                        <p class="text-[11px] text-gray-400 mb-1">Selesai Pada</p>
                        <p class="font-semibold text-gray-800">{{ $kontrak->selesai_pada->translatedFormat('d F Y') }}</p>
                    </div>
                @endif
            </div>
        </div>

        {{-- Aksi: Tandai Selesai --}}
        @if ($kontrak->status === 'berlangsung')
            <div class="bg-white rounded-2xl border border-gray-100 shadow-sm p-6 mb-6">
                <h2 class="font-bold text-gray-900 text-sm mb-2">
                    <i class="fa-solid fa-circle-check text-primary mr-1"></i> Tandai Pekerjaan Selesai
                </h2>
                <p class="text-[11px] text-gray-500 mb-4">Tandai jika pekerja sudah menyelesaikan pekerjaan ini, agar Anda
                    bisa mengunggah bukti transfer pembayaran.</p>
                <form action="{{ route('pemberi-kerja.kontrak.selesai', $kontrak->id) }}" method="POST">
                    @csrf
                    <button type="button" onclick="konfirmasiSelesai(this)"
                        class="bg-primary hover:bg-primary-hover text-white font-bold px-5 py-2.5 rounded-xl text-sm transition">
                        Tandai Selesai
                    </button>
                </form>
            </div>
        @endif

        {{-- Upload Bukti Transfer --}}
        @if ($kontrak->status === 'selesai' || $kontrak->status === 'dibayar')
            <div class="bg-white rounded-2xl border border-gray-100 shadow-sm p-6">
                <h2 class="font-bold text-gray-900 text-sm mb-2">
                    <i class="fa-solid fa-receipt text-primary mr-1"></i> Bukti Transfer
                </h2>

                @if ($kontrak->bukti_transfer)
                    <div class="mb-4">
                        <p class="text-[11px] text-gray-500 mb-2">Bukti transfer yang sudah diunggah:</p>
                        @if (str_ends_with($kontrak->bukti_transfer, '.pdf'))
                            <a href="{{ $kontrak->bukti_transfer_url }}" target="_blank"
                                class="inline-flex items-center gap-2 bg-gray-50 border border-gray-200 rounded-xl px-4 py-3 text-sm text-primary font-semibold hover:bg-gray-100">
                                <i class="fa-solid fa-file-pdf"></i> Lihat Bukti Transfer (PDF)
                            </a>
                        @else
                            <a href="{{ $kontrak->bukti_transfer_url }}" target="_blank">
                                <img src="{{ $kontrak->bukti_transfer_url }}" alt="Bukti Transfer"
                                    class="max-w-xs rounded-xl border border-gray-200">
                            </a>
                        @endif
                    </div>
                @endif

                @if ($kontrak->status === 'selesai')
                    <p class="text-[11px] text-gray-500 mb-3">
                        {{ $kontrak->bukti_transfer ? 'Unggah ulang jika ada kesalahan:' : 'Silakan unggah bukti transfer setelah Anda melakukan pembayaran ke pekerja.' }}
                    </p>
                    <form action="{{ route('pemberi-kerja.kontrak.bukti', $kontrak->id) }}" method="POST"
                        enctype="multipart/form-data" class="flex items-center gap-3">
                        @csrf
                        <input type="file" name="bukti_transfer" accept=".jpg,.jpeg,.png,.pdf" required
                            class="text-xs border border-gray-200 rounded-xl px-3 py-2 flex-1 file:mr-3 file:py-1.5 file:px-3 file:rounded-full file:border-0 file:bg-primary file:text-white file:text-xs file:font-bold">
                        <button type="submit"
                            class="bg-primary hover:bg-primary-hover text-white font-bold px-5 py-2.5 rounded-xl text-sm transition whitespace-nowrap">
                            Unggah
                        </button>
                    </form>
                    @error('bukti_transfer')
                        <p class="text-red-500 text-[11px] mt-2">{{ $message }}</p>
                    @enderror
                @endif

                @if ($kontrak->status === 'dibayar')
                    <div class="bg-green-50 border border-green-100 rounded-xl p-4 mt-2">
                        <p class="text-xs text-green-700 font-semibold">
                            <i class="fa-solid fa-check-circle mr-1"></i> Pembayaran sudah dikonfirmasi diterima oleh
                            pekerja.
                        </p>
                    </div>
                @endif
            </div>
        @endif
    </div>

    @push('scripts')
        <script>
            function konfirmasiSelesai(tombol) {
                Swal.fire({
                    title: 'Tandai pekerjaan ini selesai?',
                    text: 'Anda akan bisa mengunggah bukti transfer setelah ini.',
                    icon: 'question',
                    showCancelButton: true,
                    confirmButtonColor: '#0F766E',
                    cancelButtonColor: '#6B7280',
                    confirmButtonText: 'Ya, tandai selesai',
                    cancelButtonText: 'Batal',
                }).then((result) => {
                    if (result.isConfirmed) {
                        tombol.closest('form').submit();
                    }
                });
            }

            @if (session('success'))
                Swal.fire({
                    icon: 'success',
                    title: 'Berhasil',
                    text: '{{ session('success') }}',
                    timer: 2500,
                    showConfirmButton: false
                });
            @endif

            @if (session('error'))
                Swal.fire({
                    icon: 'error',
                    title: 'Gagal',
                    text: '{{ session('error') }}'
                });
            @endif
        </script>
    @endpush
@endsection
