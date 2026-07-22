@extends('layouts.admin')

@section('title', 'Dashboard Admin')

@section('content')
    <div class="mb-6">
        <h1 class="text-2xl font-bold text-gray-900">Dashboard Admin</h1>
        <p class="text-gray-600 text-sm">Halo, {{ auth()->user()->nama }}. Selamat datang kembali.</p>
    </div>

    <div class="bg-white rounded-2xl border border-gray-100 shadow-sm p-6">
        <p class="text-sm text-gray-500">Statistik dan grafik akan ditampilkan di sini setelah Modul Dashboard Admin
            (Modul 5) dikerjakan.</p>
    </div>
@endsection
