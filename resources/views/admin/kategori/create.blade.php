@extends('layouts.admin')

@section('title', 'Tambah Kategori')

@section('content')
    <div class="max-w-lg mx-auto">
        <div class="mb-6">
            <a href="{{ route('admin.kategori.index') }}"
                class="inline-flex items-center gap-2 text-sm text-gray-500 hover:text-primary mb-3 transition">
                <i class="fa-solid fa-arrow-left"></i>
                <span>Kembali</span>
            </a>
            <h1 class="text-2xl font-bold text-gray-900">Tambah Kategori</h1>
            <p class="text-gray-600 text-sm">Buat kategori pekerjaan baru.</p>
        </div>

        <form action="{{ route('admin.kategori.store') }}" method="POST"
            class="bg-white rounded-2xl border border-gray-100 shadow-sm p-6 space-y-5">
            @csrf

            <div>
                <label class="block text-xs font-bold text-gray-700 mb-1">Nama Kategori</label>
                <input type="text" name="nama" value="{{ old('nama') }}" placeholder="Contoh: Tukang Kebun"
                    class="w-full border border-gray-200 rounded-xl px-4 py-3 text-sm focus:outline-none focus:ring-2 focus:ring-primary">
                @error('nama')
                    <p class="text-red-500 text-[11px] mt-1">{{ $message }}</p>
                @enderror
            </div>

            <div class="flex gap-3 pt-2">
                <a href="{{ route('admin.kategori.index') }}"
                    class="flex-1 text-center bg-gray-100 hover:bg-gray-200 text-gray-700 font-bold py-3 rounded-xl text-sm transition">
                    Batal
                </a>
                <button type="submit"
                    class="flex-1 bg-primary hover:bg-primary-hover text-white font-bold py-3 rounded-xl text-sm transition">
                    Simpan Kategori
                </button>
            </div>
        </form>
    </div>
@endsection
