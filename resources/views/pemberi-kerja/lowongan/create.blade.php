@extends('layouts.app')

@section('title', 'Buat Lowongan')

@section('content')
    <div class="max-w-3xl mx-auto">
        <div class="mb-6">
            <a href="{{ route('pemberi-kerja.lowongan.index') }}"
                class="inline-flex items-center gap-2 text-sm text-gray-500 hover:text-primary mb-3 transition">
                <i class="fa-solid fa-arrow-left"></i>
                <span>Kembali</span>
            </a>
            <h1 class="text-2xl font-bold text-gray-900">Buat Lowongan Baru</h1>
            <p class="text-gray-600 text-sm">Isi detail pekerjaan yang Anda tawarkan.</p>
        </div>

        <form action="{{ route('pemberi-kerja.lowongan.store') }}" method="POST"
            class="bg-white rounded-2xl border border-gray-100 shadow-sm p-6 space-y-5">
            @csrf

            <div>
                <label class="block text-xs font-bold text-gray-700 mb-1">Judul Lowongan</label>
                <input type="text" name="judul" value="{{ old('judul') }}" placeholder="Contoh: Tukang Kebun Harian"
                    class="w-full border border-gray-200 rounded-xl px-4 py-3 text-sm focus:outline-none focus:ring-2 focus:ring-primary">
                @error('judul')
                    <p class="text-red-500 text-[11px] mt-1">{{ $message }}</p>
                @enderror
            </div>

            <div>
                <label class="block text-xs font-bold text-gray-700 mb-1">Nama Perusahaan <span
                        class="text-gray-400 font-normal">(opsional)</span></label>
                <input type="text" name="nama_perusahaan" value="{{ old('nama_perusahaan') }}"
                    placeholder="Kosongkan jika perorangan"
                    class="w-full border border-gray-200 rounded-xl px-4 py-3 text-sm focus:outline-none focus:ring-2 focus:ring-primary">
                @error('nama_perusahaan')
                    <p class="text-red-500 text-[11px] mt-1">{{ $message }}</p>
                @enderror
            </div>

            <div class="grid grid-cols-2 gap-4">
                <div>
                    <label class="block text-xs font-bold text-gray-700 mb-1">Kategori</label>
                    <select name="kategori"
                        class="w-full border border-gray-200 rounded-xl px-4 py-3 text-sm focus:outline-none focus:ring-2 focus:ring-primary">
                        @php
                            $kategoriList = [
                                'Pertukangan',
                                'ART',
                                'Buruh Harian',
                                'Supir',
                                'Security',
                                'Tukang Kebun',
                                'Laundry',
                                'Lainnya',
                            ];
                        @endphp
                        @foreach ($kategoriList as $kat)
                            <option value="{{ $kat }}" {{ old('kategori') === $kat ? 'selected' : '' }}>
                                {{ $kat }}</option>
                        @endforeach
                    </select>
                    @error('kategori')
                        <p class="text-red-500 text-[11px] mt-1">{{ $message }}</p>
                    @enderror
                </div>

                <div>
                    <label class="block text-xs font-bold text-gray-700 mb-1">Kuota Pekerja</label>
                    <input type="number" name="kuota_pekerja" min="1" value="{{ old('kuota_pekerja', 1) }}"
                        class="w-full border border-gray-200 rounded-xl px-4 py-3 text-sm focus:outline-none focus:ring-2 focus:ring-primary">
                    @error('kuota_pekerja')
                        <p class="text-red-500 text-[11px] mt-1">{{ $message }}</p>
                    @enderror
                </div>
            </div>

            <div class="grid grid-cols-2 gap-4">
                <div>
                    <label class="block text-xs font-bold text-gray-700 mb-1">Upah (Rp)</label>
                    <input type="number" name="upah" min="0" value="{{ old('upah') }}" placeholder="100000"
                        class="w-full border border-gray-200 rounded-xl px-4 py-3 text-sm focus:outline-none focus:ring-2 focus:ring-primary">
                    @error('upah')
                        <p class="text-red-500 text-[11px] mt-1">{{ $message }}</p>
                    @enderror
                </div>

                <div>
                    <label class="block text-xs font-bold text-gray-700 mb-1">Satuan Upah</label>
                    <select name="satuan_upah"
                        class="w-full border border-gray-200 rounded-xl px-4 py-3 text-sm focus:outline-none focus:ring-2 focus:ring-primary">
                        <option value="harian" {{ old('satuan_upah') === 'harian' ? 'selected' : '' }}>Harian</option>
                        <option value="borongan" {{ old('satuan_upah') === 'borongan' ? 'selected' : '' }}>Borongan
                        </option>
                    </select>
                    @error('satuan_upah')
                        <p class="text-red-500 text-[11px] mt-1">{{ $message }}</p>
                    @enderror
                </div>
            </div>

            <div>
                <label class="block text-xs font-bold text-gray-700 mb-1">Deskripsi Pekerjaan</label>
                <textarea name="deskripsi" rows="4" placeholder="Jelaskan detail pekerjaan, jam kerja, dan kebutuhan lainnya"
                    class="w-full border border-gray-200 rounded-xl px-4 py-3 text-sm focus:outline-none focus:ring-2 focus:ring-primary">{{ old('deskripsi') }}</textarea>
                @error('deskripsi')
                    <p class="text-red-500 text-[11px] mt-1">{{ $message }}</p>
                @enderror
            </div>

            <div>
                <label class="block text-xs font-bold text-gray-700 mb-1">Alamat Lokasi</label>
                <input type="text" name="lokasi" id="input-lokasi-teks" value="{{ old('lokasi') }}"
                    placeholder="Contoh: Jl. Raya Padalarang No. 10"
                    class="w-full border border-gray-200 rounded-xl px-4 py-3 text-sm focus:outline-none focus:ring-2 focus:ring-primary">
                @error('lokasi')
                    <p class="text-red-500 text-[11px] mt-1">{{ $message }}</p>
                @enderror
            </div>

            <div>
                <label class="block text-xs font-bold text-gray-700 mb-1">Titik Lokasi di Peta</label>
                <p class="text-[11px] text-gray-400 mb-2">Klik pada peta atau geser marker untuk menentukan titik lokasi
                    pekerjaan.</p>
                <div id="peta-pilih-lokasi" class="w-full h-80 rounded-2xl border border-gray-200 shadow-sm z-0"></div>
                <input type="hidden" name="latitude" id="input-latitude" value="{{ old('latitude') }}">
                <input type="hidden" name="longitude" id="input-longitude" value="{{ old('longitude') }}">
                @error('latitude')
                    <p class="text-red-500 text-[11px] mt-1">{{ $message }}</p>
                @enderror
                @error('longitude')
                    <p class="text-red-500 text-[11px] mt-1">{{ $message }}</p>
                @enderror
            </div>

            <div class="flex gap-3 pt-2">
                <a href="{{ route('pemberi-kerja.lowongan.index') }}"
                    class="flex-1 text-center bg-gray-100 hover:bg-gray-200 text-gray-700 font-bold py-3 rounded-xl text-sm transition">
                    Batal
                </a>
                <button type="submit"
                    class="flex-1 bg-primary hover:bg-primary-hover text-white font-bold py-3 rounded-xl text-sm transition">
                    Simpan Lowongan
                </button>
            </div>
        </form>
    </div>

    @push('scripts')
        <link rel="stylesheet" href="https://unpkg.com/leaflet@1.9.4/dist/leaflet.css"
            integrity="sha256-p4NxAoJBhIIN+hmNHrzRCf9tD/miZyoHS5obTRR9BMY=" crossorigin="" />
        <script src="https://unpkg.com/leaflet@1.9.4/dist/leaflet.js"
            integrity="sha256-20nQCchB9co0qIjJZRGuk2/Z9VM+kNiyxNV1lvTlZBo=" crossorigin=""></script>

        <script>
            const lokasiAwal = {
                lat: {{ old('latitude', auth()->user()->latitude ?? -6.8385) }},
                lng: {{ old('longitude', auth()->user()->longitude ?? 107.4855) }}
            };

            const peta = L.map('peta-pilih-lokasi').setView([lokasiAwal.lat, lokasiAwal.lng], 13);

            L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
                attribution: '&copy; OpenStreetMap contributors',
                maxZoom: 19,
            }).addTo(peta);

            let marker = L.marker([lokasiAwal.lat, lokasiAwal.lng], {
                draggable: true
            }).addTo(peta);

            function perbaruiInput(latlng) {
                document.getElementById('input-latitude').value = latlng.lat;
                document.getElementById('input-longitude').value = latlng.lng;
            }

            // Isi input hidden dari posisi marker awal (kalau old() kosong, pakai lokasi default)
            perbaruiInput(marker.getLatLng());

            marker.on('dragend', function(e) {
                perbaruiInput(e.target.getLatLng());
            });

            peta.on('click', function(e) {
                marker.setLatLng(e.latlng);
                perbaruiInput(e.latlng);
            });
        </script>
    @endpush
@endsection
