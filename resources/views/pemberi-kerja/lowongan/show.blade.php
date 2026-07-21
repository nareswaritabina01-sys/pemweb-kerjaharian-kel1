@extends('layouts.app')

@section('title', 'Detail Lowongan')

@section('content')
    <div class="max-w-4xl mx-auto">
        <div class="flex items-center justify-between mb-6">
            <div>
                <a href="{{ route('pemberi-kerja.lowongan.index') }}"
                    class="inline-flex items-center gap-2 text-sm text-gray-500 hover:text-primary mb-3 transition">
                    <i class="fa-solid fa-arrow-left"></i>
                    <span>Kembali</span>
                </a>
                <h1 class="text-2xl font-bold text-gray-900">{{ $lowongan->judul }}</h1>
                <p class="text-gray-600 text-sm">{{ $lowongan->nama_perusahaan ?? 'Perorangan' }}</p>
            </div>
            <a href="{{ route('pemberi-kerja.lowongan.edit', $lowongan->id) }}"
                class="bg-gray-100 hover:bg-gray-200 text-gray-700 font-bold px-5 py-2.5 rounded-full text-sm transition flex items-center gap-2">
                <i class="fa-solid fa-pen"></i> Edit
            </a>
        </div>

        {{-- Detail Lowongan --}}
        <div class="bg-white rounded-2xl border border-gray-100 shadow-sm p-6 mb-6">
            <div class="flex items-center justify-between mb-4">
                <span
                    class="text-[10px] font-bold px-3 py-1 rounded-full
                    {{ $lowongan->status === 'dibuka' ? 'bg-green-100 text-green-700' : 'bg-gray-200 text-gray-600' }}">
                    {{ ucfirst($lowongan->status) }}
                </span>
                <span class="text-xs text-gray-400">Dibuat {{ $lowongan->created_at->diffForHumans() }}</span>
            </div>

            <div class="grid grid-cols-2 gap-4 mb-4 text-sm">
                <div>
                    <p class="text-[11px] text-gray-400 mb-1">Kategori</p>
                    <p class="font-semibold text-gray-800">{{ $lowongan->kategori }}</p>
                </div>
                <div>
                    <p class="text-[11px] text-gray-400 mb-1">Upah</p>
                    <p class="font-bold text-primary">Rp {{ number_format($lowongan->upah, 0, ',', '.') }} /
                        {{ $lowongan->satuan_upah }}</p>
                </div>
                <div>
                    <p class="text-[11px] text-gray-400 mb-1">Kuota Pekerja</p>
                    <p class="font-semibold text-gray-800">{{ $lowongan->kuota_pekerja }} orang</p>
                </div>
                <div>
                    <p class="text-[11px] text-gray-400 mb-1">Sisa Slot</p>
                    <p class="font-semibold text-gray-800">{{ $lowongan->sisa_kuota }} orang</p>
                </div>
            </div>

            <div class="mb-4">
                <p class="text-[11px] text-gray-400 mb-1">Lokasi</p>
                <p class="font-semibold text-gray-800 text-sm"><i
                        class="fa-solid fa-location-dot text-primary mr-1"></i>{{ $lowongan->lokasi }}</p>
            </div>

            <div>
                <p class="text-[11px] text-gray-400 mb-1">Deskripsi</p>
                <p class="text-gray-700 text-sm leading-relaxed">{{ $lowongan->deskripsi }}</p>
            </div>
        </div>

        {{-- Peta Lokasi --}}
        <div id="peta-detail-lowongan" class="w-full h-64 rounded-2xl border border-gray-200 shadow-sm mb-6 z-0"></div>

        {{-- Daftar Pelamar --}}
        <div class="bg-white rounded-2xl border border-gray-100 shadow-sm p-6">
            <h2 class="font-bold text-gray-900 text-sm mb-4">
                <i class="fa-solid fa-users text-primary mr-1"></i> Daftar Pelamar ({{ $lowongan->lamaran->count() }})
            </h2>

            @forelse ($lowongan->lamaran as $lamaran)
                <div class="flex items-center justify-between border-b border-gray-100 py-3 last:border-0">
                    <div class="flex items-center gap-3">
                        <img src="{{ $lamaran->pencariKerja->foto_profil_url }}" alt="{{ $lamaran->pencariKerja->nama }}"
                            class="w-10 h-10 rounded-full object-cover border border-gray-100">
                        <div>
                            <p class="font-semibold text-gray-800 text-sm">{{ $lamaran->pencariKerja->nama }}</p>
                            <p class="text-[11px] text-gray-400">Melamar {{ $lamaran->created_at->diffForHumans() }}</p>
                            @if ($lamaran->pesan)
                                <p class="text-[11px] text-gray-500 italic mt-1">"{{ $lamaran->pesan }}"</p>
                            @endif
                        </div>
                    </div>

                    @if ($lamaran->status === 'menunggu')
                        <div class="flex gap-2">
                            <form action="{{ route('pemberi-kerja.lamaran.terima', $lamaran->id) }}" method="POST">
                                @csrf
                                <button type="button"
                                    onclick="konfirmasiAksi(this, 'Terima lamaran ini?', 'Pelamar akan mendapat kontrak kerja otomatis.', '#22C55E')"
                                    class="bg-green-50 hover:bg-green-100 text-green-700 font-bold px-4 py-2 rounded-full text-[11px] transition">
                                    <i class="fa-solid fa-check mr-1"></i> Terima
                                </button>
                            </form>
                            <form action="{{ route('pemberi-kerja.lamaran.tolak', $lamaran->id) }}" method="POST">
                                @csrf
                                <button type="button"
                                    onclick="konfirmasiAksi(this, 'Tolak lamaran ini?', 'Tindakan ini tidak bisa dibatalkan.', '#EF4444')"
                                    class="bg-red-50 hover:bg-red-100 text-red-600 font-bold px-4 py-2 rounded-full text-[11px] transition">
                                    <i class="fa-solid fa-xmark mr-1"></i> Tolak
                                </button>
                            </form>
                        </div>
                    @else
                        <span
                            class="text-[10px] font-bold px-3 py-1 rounded-full
                            @class([
                                'bg-green-100 text-green-700' => $lamaran->status === 'diterima',
                                'bg-red-100 text-red-700' => $lamaran->status === 'ditolak',
                            ])">
                            {{ ucfirst($lamaran->status) }}
                        </span>
                    @endif
                </div>
            @empty
                <div class="text-center py-10 text-gray-400">
                    <i class="fa-solid fa-inbox text-2xl mb-2"></i>
                    <p class="text-sm">Belum ada yang melamar lowongan ini.</p>
                </div>
            @endforelse
        </div>
    </div>

    @push('scripts')
        <link rel="stylesheet" href="https://unpkg.com/leaflet@1.9.4/dist/leaflet.css"
            integrity="sha256-p4NxAoJBhIIN+hmNHrzRCf9tD/miZyoHS5obTRR9BMY=" crossorigin="" />
        <script src="https://unpkg.com/leaflet@1.9.4/dist/leaflet.js"
            integrity="sha256-20nQCchB9co0qIjJZRGuk2/Z9VM+kNiyxNV1lvTlZBo=" crossorigin=""></script>

        <script>
            const titikLowongan = {
                lat: {{ $lowongan->latitude }},
                lng: {{ $lowongan->longitude }}
            };

            const peta = L.map('peta-detail-lowongan').setView([titikLowongan.lat, titikLowongan.lng], 14);

            L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
                attribution: '&copy; OpenStreetMap contributors',
                maxZoom: 19,
            }).addTo(peta);

            L.marker([titikLowongan.lat, titikLowongan.lng]).addTo(peta)
                .bindPopup('{{ addslashes($lowongan->judul) }}')
                .openPopup();
        </script>

        <script>
            function konfirmasiAksi(tombol, judul, teks, warna) {
                Swal.fire({
                    title: judul,
                    text: teks,
                    icon: 'question',
                    showCancelButton: true,
                    confirmButtonColor: warna,
                    cancelButtonColor: '#6B7280',
                    confirmButtonText: 'Ya, lanjutkan',
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
        </script>
    @endpush
@endsection
