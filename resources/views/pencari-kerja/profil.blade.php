@extends('layouts.app')

@section('content')
    <div class="flex justify-between items-center mb-6">
        <div>
            <h1 class="text-2xl font-bold text-gray-900">Profil Saya</h1>
            <p class="text-gray-600 text-sm">Kelola informasi profil dan data rekening untuk kelancaran lamaran & pembayaran.
            </p>
        </div>

        <form action="{{ route('logout') }}" method="POST">
            @csrf
            <button type="submit"
                class="bg-red-50 text-red-600 hover:bg-red-100 font-bold px-4 py-2 rounded-lg text-xs transition border border-red-200">
                <i class="fa-solid fa-right-from-bracket mr-1"></i> Keluar
            </button>
        </form>
    </div>

    <div class="grid grid-cols-1 lg:grid-cols-3 gap-6">
        {{-- Kartu Ringkasan --}}
        <div class="bg-white border border-gray-200 rounded-2xl p-6 shadow-sm flex flex-col items-center text-center h-fit">
            <div class="relative">
                <img src="{{ $user->foto_profil_url }}" class="w-24 h-24 rounded-full object-cover bg-gray-200 shadow-inner"
                    alt="{{ $user->nama }}">
                <form action="{{ route('pencari-kerja.profil.foto') }}" method="POST" enctype="multipart/form-data"
                    id="formFoto">
                    @csrf
                    <label for="inputFoto"
                        class="absolute bottom-0 right-0 bg-primary text-white p-2 rounded-full text-xs shadow-md hover:bg-primary-hover transition cursor-pointer">
                        <i class="fa-solid fa-camera"></i>
                    </label>
                    <input type="file" name="foto_profil" id="inputFoto" accept="image/*" class="hidden"
                        onchange="document.getElementById('formFoto').submit()">
                </form>
            </div>
            <h2 class="text-base font-bold text-gray-900 mt-4">{{ $user->nama }}</h2>
            <p class="text-xs text-gray-500 mt-0.5">{{ $user->email }}</p>

            <div
                class="mt-3 flex items-center space-x-1.5 {{ $user->status_aktif ? 'bg-green-50 text-green-700' : 'bg-gray-100 text-gray-500' }} px-2.5 py-1 rounded-full text-[10px] font-bold">
                <i class="fa-solid fa-shield-{{ $user->status_aktif ? 'check' : 'xmark' }}"></i>
                <span>{{ $user->status_aktif ? 'Akun Aktif' : 'Akun Nonaktif' }}</span>
            </div>

            <div class="w-full border-t border-gray-100 mt-6 pt-4">
                <span class="text-[10px] text-gray-400 block uppercase tracking-wider font-bold mb-1.5">Kelengkapan
                    Profil</span>
                <div class="w-full bg-gray-100 rounded-full h-2">
                    <div class="bg-primary h-2 rounded-full" style="width: {{ $user->kelengkapan_profil }}%"></div>
                </div>
                <span class="text-[10px] text-gray-500 mt-1 block">{{ $user->kelengkapan_profil }}% lengkap</span>
            </div>
        </div>

        {{-- Form Edit --}}
        <div class="lg:col-span-2 space-y-6">
            <form action="{{ route('pencari-kerja.profil.update') }}" method="POST">
                @csrf
                @method('PUT')

                <div class="bg-white border border-gray-200 rounded-2xl p-6 shadow-sm">
                    <h3 class="text-sm font-bold text-gray-900 mb-4 border-b border-gray-100 pb-3">Informasi Diri</h3>

                    <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                        <div>
                            <label class="block text-xs font-bold text-gray-700 mb-1.5">Nama Lengkap</label>
                            <input type="text" name="nama" value="{{ old('nama', $user->nama) }}"
                                class="w-full text-xs text-gray-700 border border-gray-200 rounded-xl p-3 focus:outline-none focus:ring-2 focus:ring-primary">
                            @error('nama')
                                <p class="text-[11px] text-red-500 mt-1">{{ $message }}</p>
                            @enderror
                        </div>

                        <div>
                            <label class="block text-xs font-bold text-gray-700 mb-1.5">Nomor Telepon</label>
                            <input type="text" name="no_telepon" value="{{ old('no_telepon', $user->no_telepon) }}"
                                class="w-full text-xs text-gray-700 border border-gray-200 rounded-xl p-3 focus:outline-none focus:ring-2 focus:ring-primary">
                            @error('no_telepon')
                                <p class="text-[11px] text-red-500 mt-1">{{ $message }}</p>
                            @enderror
                        </div>
                    </div>

                    <div class="mt-4">
                        <label class="block text-xs font-bold text-gray-700 mb-1.5">Alamat</label>
                        <textarea name="alamat" rows="2"
                            class="w-full text-xs text-gray-700 border border-gray-200 rounded-xl p-3 focus:outline-none focus:ring-2 focus:ring-primary">{{ old('alamat', $user->alamat) }}</textarea>
                        @error('alamat')
                            <p class="text-[11px] text-red-500 mt-1">{{ $message }}</p>
                        @enderror
                    </div>

                    <div class="mt-4">
                        <label class="block text-xs font-bold text-gray-700 mb-1.5">Tentang Saya</label>
                        <textarea name="bio" rows="3" placeholder="Ceritakan pengalaman dan keahlian Anda..."
                            class="w-full text-xs text-gray-700 border border-gray-200 rounded-xl p-3 focus:outline-none focus:ring-2 focus:ring-primary">{{ old('bio', $user->bio) }}</textarea>
                        @error('bio')
                            <p class="text-[11px] text-red-500 mt-1">{{ $message }}</p>
                        @enderror
                    </div>

                    <div class="grid grid-cols-1 md:grid-cols-2 gap-4 mt-4">
                        <div>
                            <label class="block text-xs font-bold text-gray-700 mb-1.5">Latitude</label>
                            <input type="text" name="latitude" value="{{ old('latitude', $user->latitude) }}"
                                class="w-full text-xs text-gray-700 border border-gray-200 rounded-xl p-3 focus:outline-none focus:ring-2 focus:ring-primary"
                                placeholder="-6.9147">
                        </div>
                        <div>
                            <label class="block text-xs font-bold text-gray-700 mb-1.5">Longitude</label>
                            <input type="text" name="longitude" value="{{ old('longitude', $user->longitude) }}"
                                class="w-full text-xs text-gray-700 border border-gray-200 rounded-xl p-3 focus:outline-none focus:ring-2 focus:ring-primary"
                                placeholder="107.6098">
                        </div>
                    </div>
                    <button type="button" id="btnLokasiSaya"
                        class="mt-2 text-[11px] font-bold text-primary hover:underline">
                        <i class="fa-solid fa-location-crosshairs mr-1"></i> Gunakan Lokasi Saya Saat Ini
                    </button>
                </div>

                <div class="bg-white border border-gray-200 rounded-2xl p-6 shadow-sm mt-6">
                    <h3 class="text-sm font-bold text-gray-900 mb-4 border-b border-gray-100 pb-3">Data Rekening (untuk
                        Pembayaran)</h3>

                    <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                        <div>
                            <label class="block text-xs font-bold text-gray-700 mb-1.5">Nama Bank</label>
                            <input type="text" name="nama_bank" value="{{ old('nama_bank', $user->nama_bank) }}"
                                class="w-full text-xs text-gray-700 border border-gray-200 rounded-xl p-3 focus:outline-none focus:ring-2 focus:ring-primary"
                                placeholder="BCA, BRI, Mandiri, dll">
                        </div>
                        <div>
                            <label class="block text-xs font-bold text-gray-700 mb-1.5">Nomor Rekening</label>
                            <input type="text" name="nomor_rekening"
                                value="{{ old('nomor_rekening', $user->nomor_rekening) }}"
                                class="w-full text-xs text-gray-700 border border-gray-200 rounded-xl p-3 focus:outline-none focus:ring-2 focus:ring-primary">
                        </div>
                    </div>
                    <div class="mt-4">
                        <label class="block text-xs font-bold text-gray-700 mb-1.5">Nama Pemilik Rekening</label>
                        <input type="text" name="nama_pemilik_rekening"
                            value="{{ old('nama_pemilik_rekening', $user->nama_pemilik_rekening) }}"
                            class="w-full text-xs text-gray-700 border border-gray-200 rounded-xl p-3 focus:outline-none focus:ring-2 focus:ring-primary">
                    </div>

                    @unless ($user->rekeningLengkap())
                        <div class="mt-3 p-3 bg-amber-50 border border-amber-100 rounded-xl text-[11px] text-amber-700">
                            <i class="fa-solid fa-triangle-exclamation mr-1"></i> Lengkapi data rekening agar Anda bisa
                            menerima konfirmasi pembayaran dari pemberi kerja.
                        </div>
                    @endunless
                </div>

                <button type="submit"
                    class="bg-primary text-white font-bold px-5 py-2.5 mt-6 rounded-xl text-xs hover:bg-primary-hover transition">
                    Simpan Perubahan
                </button>
            </form>
        </div>
    </div>

    @push('scripts')
        <script>
            const btnLokasi = document.getElementById('btnLokasiSaya');
            if (btnLokasi) {
                btnLokasi.addEventListener('click', function() {
                    if (!navigator.geolocation) return;
                    navigator.geolocation.getCurrentPosition(function(pos) {
                        document.querySelector('input[name="latitude"]').value = pos.coords.latitude;
                        document.querySelector('input[name="longitude"]').value = pos.coords.longitude;
                    });
                });
            }
        </script>
    @endpush
@endsection
