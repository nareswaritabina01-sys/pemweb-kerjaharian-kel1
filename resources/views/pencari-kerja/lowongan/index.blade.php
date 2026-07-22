@extends('layouts.app')

@section('title', 'Cari Kerja')

@section('content')
    <div class="max-w-7xl mx-auto">
        <div class="mb-6">
            <h1 class="text-2xl font-bold text-gray-900">Cari Kerja</h1>
            <p class="text-gray-600 text-sm">Temukan lowongan kerja harian di sekitar lokasi Anda.</p>
        </div>

        {{-- Form Pencarian --}}
        <form id="form-pencarian-lowongan" action="{{ route('pencari-kerja.lowongan.index') }}" method="GET"
            class="mb-6 space-y-4">
            <div class="flex items-center bg-white rounded-full border border-gray-200 shadow-sm p-2">
                <i class="fa-solid fa-magnifying-glass text-gray-400 px-4"></i>
                <input type="text" name="pencarian" value="{{ request('pencarian') }}"
                    placeholder="Cari pekerjaan, lokasi, atau keahlian..."
                    class="w-full focus:outline-none text-sm text-gray-700 bg-transparent">
                <button type="submit"
                    class="bg-primary hover:bg-primary-hover text-white font-bold px-6 py-2.5 rounded-full text-sm transition">
                    Cari
                </button>
            </div>

            <div class="flex flex-wrap gap-2 justify-center">
                @foreach ($kategoriList as $kat)
                    <button type="submit" name="kategori" value="{{ $kat->id }}"
                        class="px-4 py-2 rounded-full border text-xs font-semibold transition
            {{ (int) request('kategori') === $kat->id ? 'bg-primary text-white border-primary' : 'bg-white text-gray-600 border-gray-200 hover:border-primary hover:text-primary' }}">
                        {{ $kat->nama }}
                    </button>
                @endforeach
            </div>

            <input type="hidden" name="latitude" id="input-latitude" value="{{ request('latitude') }}">
            <input type="hidden" name="longitude" id="input-longitude" value="{{ request('longitude') }}">

            <div class="flex items-center justify-center gap-3 text-xs">
                <button type="button" id="btn-lokasi-saya"
                    class="text-primary font-bold hover:underline flex items-center gap-1.5">
                    <i class="fa-solid fa-location-crosshairs"></i> Gunakan Lokasi Saya
                </button>
                @if (request('latitude'))
                    <select name="radius" onchange="this.form.submit()"
                        class="border border-gray-200 rounded-lg text-xs px-2 py-1">
                        <option value="">Semua Jarak</option>
                        <option value="5" {{ request('radius') == '5' ? 'selected' : '' }}>Radius 5 km</option>
                        <option value="10" {{ request('radius') == '10' ? 'selected' : '' }}>Radius 10 km</option>
                        <option value="25" {{ request('radius') == '25' ? 'selected' : '' }}>Radius 25 km</option>
                    </select>
                @endif
            </div>
        </form>

        {{-- Peta --}}
        <div id="peta-lowongan" class="w-full h-80 rounded-2xl border border-gray-200 shadow-sm mb-8 z-0"></div>

        {{-- Grid Lowongan --}}
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
            @forelse($lowongan as $job)
                <div
                    class="bg-white rounded-2xl border border-gray-100 shadow-sm overflow-hidden hover:shadow-lg transition">
                    <div class="h-28 bg-teal-50 flex items-center justify-center">
                        <i class="fa-solid fa-location-dot text-primary text-2xl"></i>
                    </div>
                    <div class="p-5">
                        <h3 class="font-bold text-gray-900 text-sm mb-1">{{ $job->judul }}</h3>
                        <p class="text-[11px] text-gray-500 mb-1">
                            <i class="fa-solid fa-building mr-1"></i>{{ $job->nama_perusahaan ?? 'Perorangan' }}
                        </p>
                        <p class="text-[11px] text-gray-500 mb-3">
                            <i class="fa-solid fa-location-dot mr-1"></i>{{ $job->lokasi }}
                            @if (isset($job->jarak))
                                <span class="text-primary font-bold">• {{ number_format($job->jarak, 1) }} km</span>
                            @endif
                        </p>
                        <p class="font-bold text-primary text-xs mb-4">
                            Rp {{ number_format($job->upah, 0, ',', '.') }} / {{ $job->satuan_upah }}
                        </p>
                        <div class="flex justify-between items-center text-[10px] text-gray-400 border-t pt-3 mb-4">
                            <span><i class="fa-solid fa-users mr-1"></i>Sisa {{ $job->sisa_kuota }} slot</span>
                            <span>{{ $job->created_at->diffForHumans() }}</span>
                        </div>
                        <a href="{{ route('pencari-kerja.lowongan.show', $job->id) }}"
                            class="block text-center w-full bg-secondary hover:bg-yellow-500 text-gray-900 font-bold py-3 rounded-xl text-xs transition">
                            Detail & Lamar
                        </a>
                    </div>
                </div>
            @empty
                <div class="col-span-full text-center py-16 text-gray-400">
                    <i class="fa-solid fa-inbox text-3xl mb-3"></i>
                    <p class="text-sm">Belum ada lowongan yang cocok dengan pencarian Anda.</p>
                </div>
            @endforelse
        </div>

        <div class="mt-8">
            {{ $lowongan->links() }}
        </div>
    </div>

    @push('scripts')
        <link rel="stylesheet" href="https://unpkg.com/leaflet@1.9.4/dist/leaflet.css"
            integrity="sha256-p4NxAoJBhIIN+hmNHrzRCf9tD/miZyoHS5obTRR9BMY=" crossorigin="" />
        <script src="https://unpkg.com/leaflet@1.9.4/dist/leaflet.js"
            integrity="sha256-20nQCchB9co0qIjJZRGuk2/Z9VM+kNiyxNV1lvTlZBo=" crossorigin=""></script>

        <script>
            const lokasiUser = {
                lat: {{ request('latitude', auth()->user()->latitude ?? -6.9147) }},
                lng: {{ request('longitude', auth()->user()->longitude ?? 107.6098) }}
            };

            const peta = L.map('peta-lowongan').setView([lokasiUser.lat, lokasiUser.lng], 12);

            L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
                attribution: '&copy; OpenStreetMap contributors',
                maxZoom: 19,
            }).addTo(peta);

            // Pin lokasi user
            L.marker([lokasiUser.lat, lokasiUser.lng], {
                icon: L.divIcon({
                    className: 'marker-user',
                    html: '<div style="background:#007A87;width:16px;height:16px;border-radius:50%;border:3px solid white;box-shadow:0 0 0 2px #007A87;"></div>',
                    iconSize: [16, 16],
                })
            }).addTo(peta).bindPopup('Lokasi Anda');

            // Pin tiap lowongan
            const daftarLowongan = @json($lowongan->items());
            daftarLowongan.forEach(job => {
                if (job.latitude && job.longitude) {
                    L.marker([job.latitude, job.longitude])
                        .addTo(peta)
                        .bindPopup(
                            `<strong>${job.judul}</strong><br>Rp ${Number(job.upah).toLocaleString('id-ID')}/${job.satuan_upah}<br><a href="/pencari-kerja/lowongan/${job.id}" class="text-primary">Lihat Detail</a>`
                        );
                }
            });

            // Tombol "Gunakan Lokasi Saya"
            document.getElementById('btn-lokasi-saya').addEventListener('click', function() {
                if (!navigator.geolocation) {
                    alert('Browser Anda tidak mendukung geolocation.');
                    return;
                }
                navigator.geolocation.getCurrentPosition(function(posisi) {
                    document.getElementById('input-latitude').value = posisi.coords.latitude;
                    document.getElementById('input-longitude').value = posisi.coords.longitude;
                    document.getElementById('form-pencarian-lowongan').submit();
                }, function() {
                    alert('Gagal mengambil lokasi. Pastikan izin lokasi diaktifkan.');
                });
            });
        </script>
    @endpush
@endsection
