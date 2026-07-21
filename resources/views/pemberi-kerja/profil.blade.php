@extends('layouts.app')

@section('content')
    <div class="container mx-auto px-4 py-6">
        <div class="mb-6">
            <h1 class="text-2xl font-bold text-gray-900">Profil Pemberi Kerja</h1>
            <p class="text-sm text-gray-500">Perbarui data profil dan informasi usaha Anda.</p>
        </div>

        @if (session('success'))
            <div class="mb-6 rounded-2xl bg-green-50 border border-green-100 p-4 text-sm text-green-700">
                {{ session('success') }}
            </div>
        @endif

        @if ($errors->any())
            <div class="mb-6 rounded-2xl bg-red-50 border border-red-100 p-4 text-sm text-red-700">
                <ul class="list-disc pl-5 space-y-1">
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <div class="grid gap-6 lg:grid-cols-[1fr_360px]">
            <div class="bg-white border border-gray-200 rounded-3xl p-6 shadow-sm">
                <form action="{{ route('pemberi-kerja.profil.update') }}" method="POST">
                    @csrf
                    @method('PUT')

                    <div class="mb-6">
                        <label class="block text-xs font-bold text-gray-700 mb-2">Nama</label>
                        <input type="text" name="nama" value="{{ old('nama', $user->nama) }}"
                            class="w-full rounded-2xl border border-gray-200 bg-gray-50 px-4 py-3 text-sm text-gray-700 focus:border-primary focus:outline-none focus:ring-2 focus:ring-primary/20">
                        @error('nama')
                            <p class="mt-2 text-xs text-red-500">{{ $message }}</p>
                        @enderror
                    </div>

                    <div class="mb-6">
                        <label class="block text-xs font-bold text-gray-700 mb-2">No. Telepon</label>
                        <input type="text" name="no_telepon" value="{{ old('no_telepon', $user->no_telepon) }}"
                            class="w-full rounded-2xl border border-gray-200 bg-gray-50 px-4 py-3 text-sm text-gray-700 focus:border-primary focus:outline-none focus:ring-2 focus:ring-primary/20">
                        @error('no_telepon')
                            <p class="mt-2 text-xs text-red-500">{{ $message }}</p>
                        @enderror
                    </div>

                    <div class="mb-6">
                        <label class="block text-xs font-bold text-gray-700 mb-2">Alamat</label>
                        <textarea name="alamat" rows="3"
                            class="w-full rounded-2xl border border-gray-200 bg-gray-50 px-4 py-3 text-sm text-gray-700 focus:border-primary focus:outline-none focus:ring-2 focus:ring-primary/20">{{ old('alamat', $user->alamat) }}</textarea>
                        @error('alamat')
                            <p class="mt-2 text-xs text-red-500">{{ $message }}</p>
                        @enderror
                    </div>

                    <div class="mb-6">
                        <label class="block text-xs font-bold text-gray-700 mb-2">Bio</label>
                        <textarea name="bio" rows="4"
                            class="w-full rounded-2xl border border-gray-200 bg-gray-50 px-4 py-3 text-sm text-gray-700 focus:border-primary focus:outline-none focus:ring-2 focus:ring-primary/20">{{ old('bio', $user->bio) }}</textarea>
                        @error('bio')
                            <p class="mt-2 text-xs text-red-500">{{ $message }}</p>
                        @enderror
                    </div>

                    <div class="mb-6">
                        <h2 class="text-sm font-semibold text-gray-900 mb-3">Data Usaha (Opsional)</h2>
                        <label class="block text-xs font-bold text-gray-700 mb-2">Nama Usaha</label>
                        <input type="text" name="nama_usaha" value="{{ old('nama_usaha', $user->nama_usaha) }}"
                            class="w-full rounded-2xl border border-gray-200 bg-gray-50 px-4 py-3 text-sm text-gray-700 focus:border-primary focus:outline-none focus:ring-2 focus:ring-primary/20">
                        @error('nama_usaha')
                            <p class="mt-2 text-xs text-red-500">{{ $message }}</p>
                        @enderror
                    </div>

                    <div class="mb-6">
                        <label class="block text-xs font-bold text-gray-700 mb-2">Jenis Usaha</label>
                        <input type="text" name="jenis_usaha" value="{{ old('jenis_usaha', $user->jenis_usaha) }}"
                            class="w-full rounded-2xl border border-gray-200 bg-gray-50 px-4 py-3 text-sm text-gray-700 focus:border-primary focus:outline-none focus:ring-2 focus:ring-primary/20">
                        @error('jenis_usaha')
                            <p class="mt-2 text-xs text-red-500">{{ $message }}</p>
                        @enderror
                    </div>

                    <button type="submit"
                        class="inline-flex items-center justify-center rounded-2xl bg-primary px-5 py-3 text-sm font-bold text-white transition hover:bg-primary-hover">
                        Simpan Profil
                    </button>
                </form>
            </div>

            <div class="space-y-6">
                <div class="bg-white border border-gray-200 rounded-3xl p-6 shadow-sm">
                    <h2 class="text-sm font-semibold text-gray-900 mb-4">Foto Profil</h2>
                    <div class="mb-6 flex items-center gap-4">
                        <img src="{{ $user->foto_profil_url }}" alt="{{ $user->nama }}"
                            class="h-20 w-20 rounded-full object-cover border border-gray-200 bg-gray-100">
                        <div>
                            <p class="text-sm font-semibold text-gray-900">{{ $user->nama }}</p>
                            <p class="text-xs text-gray-500">Foto profil saat ini</p>
                        </div>
                    </div>

                    <form action="{{ route('pemberi-kerja.profil.foto') }}" method="POST" enctype="multipart/form-data">
                        @csrf

                        <label class="block text-xs font-bold text-gray-700 mb-2">Unggah Foto</label>
                        <input type="file" name="foto_profil" accept="image/*"
                            class="w-full rounded-2xl border border-gray-200 bg-gray-50 px-4 py-3 text-sm text-gray-700 focus:border-primary focus:outline-none focus:ring-2 focus:ring-primary/20">
                        @error('foto_profil')
                            <p class="mt-2 text-xs text-red-500">{{ $message }}</p>
                        @enderror

                        <button type="submit"
                            class="mt-4 inline-flex items-center justify-center rounded-2xl bg-secondary px-5 py-3 text-sm font-bold text-white transition hover:bg-secondary-hover">
                            Unggah Foto
                        </button>
                    </form>
                </div>

                <div class="bg-white border border-gray-200 rounded-3xl p-6 shadow-sm">
                    <h2 class="text-sm font-semibold text-gray-900 mb-4">Kelengkapan Profil</h2>
                    <div class="rounded-2xl bg-gray-100 p-4">
                        <div class="mb-3 flex items-center justify-between text-xs text-gray-600">
                            <span>Progress kelengkapan</span>
                            <span class="font-semibold text-gray-900">{{ $user->kelengkapan_profil }}%</span>
                        </div>
                        <div class="h-2 overflow-hidden rounded-full bg-gray-200">
                            <div class="h-2 rounded-full bg-primary" style="width: {{ $user->kelengkapan_profil }}%"></div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
