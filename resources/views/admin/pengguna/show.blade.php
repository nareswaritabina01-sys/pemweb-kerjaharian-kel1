@extends('layouts.admin')

@section('title', 'Detail User')

@section('content')
    <div class="max-w-3xl mx-auto">
        <div class="mb-6 flex items-center gap-3">
            <a href="{{ route('admin.pengguna.index') }}" class="text-gray-500 hover:text-primary">
                <i class="fa-solid fa-arrow-left"></i>
            </a>
            <div>
                <h1 class="text-2xl font-bold text-gray-900">Detail User</h1>
                <p class="text-gray-600 text-sm">Informasi lengkap dan pengaturan status akun.</p>
            </div>
        </div>

        <div class="bg-white rounded-2xl border border-gray-100 shadow-sm p-6 mb-6">
            <div class="flex items-center gap-4 mb-6">
                <img src="{{ $pengguna->foto_profil_url }}" alt="{{ $pengguna->nama }}"
                    class="w-16 h-16 rounded-full object-cover border border-gray-100">
                <div>
                    <h2 class="text-lg font-bold text-gray-900">{{ $pengguna->nama }}</h2>
                    <p class="text-sm text-gray-500">{{ $pengguna->email }}</p>
                </div>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-2 gap-4 text-sm">
                <div>
                    <p class="text-gray-500 text-xs uppercase font-bold mb-1">Role</p>
                    <p class="text-gray-800 font-semibold">
                        {{ $pengguna->isPemberiKerja() ? 'Pemberi Kerja' : 'Pencari Kerja' }}
                    </p>
                </div>
                <div>
                    <p class="text-gray-500 text-xs uppercase font-bold mb-1">Status Akun</p>
                    @php
                        $badgeKelas = match ($pengguna->status_akun) {
                            'aktif' => 'bg-green-50 text-green-600',
                            'nonaktif' => 'bg-amber-50 text-amber-600',
                            'banned' => 'bg-red-50 text-red-600',
                            default => 'bg-gray-50 text-gray-600',
                        };
                    @endphp
                    <span class="px-3 py-1 rounded-full text-xs font-bold {{ $badgeKelas }}">
                        {{ ucfirst($pengguna->status_akun) }}
                    </span>
                </div>
                <div>
                    <p class="text-gray-500 text-xs uppercase font-bold mb-1">No. Telepon</p>
                    <p class="text-gray-800">{{ $pengguna->no_telepon ?? '-' }}</p>
                </div>
                <div>
                    <p class="text-gray-500 text-xs uppercase font-bold mb-1">Bergabung</p>
                    <p class="text-gray-800">{{ $pengguna->created_at->translatedFormat('d F Y') }}</p>
                </div>
                <div class="md:col-span-2">
                    <p class="text-gray-500 text-xs uppercase font-bold mb-1">Alamat</p>
                    <p class="text-gray-800">{{ $pengguna->alamat ?? '-' }}</p>
                </div>
            </div>
        </div>

        <div class="bg-white rounded-2xl border border-gray-100 shadow-sm p-6">
            <p class="text-gray-500 text-xs uppercase font-bold mb-3">Ubah Status Akun</p>
            <div class="flex gap-2">
                @foreach (['aktif' => 'Aktif', 'nonaktif' => 'Nonaktif', 'banned' => 'Banned'] as $nilai => $label)
                    <button type="button" onclick="konfirmasiUbahStatus('{{ $nilai }}', '{{ $label }}')"
                        {{ $pengguna->status_akun === $nilai ? 'disabled' : '' }}
                        class="font-bold py-2.5 px-5 rounded-xl text-sm transition
                            {{ $pengguna->status_akun === $nilai
                                ? 'bg-gray-100 text-gray-400 cursor-not-allowed'
                                : 'bg-gray-100 hover:bg-primary hover:text-white text-gray-700' }}">
                        {{ $label }}
                    </button>
                @endforeach
            </div>

            <form id="form-status" action="{{ route('admin.pengguna.update-status', $pengguna->id) }}" method="POST"
                class="hidden">
                @csrf
                @method('PATCH')
                <input type="hidden" name="status_akun" id="input-status">
            </form>
        </div>
    </div>

    @push('scripts')
        <script>
            function konfirmasiUbahStatus(statusBaru, label) {
                Swal.fire({
                    title: `Ubah status jadi ${label}?`,
                    text: 'Perubahan status akan berlaku langsung.',
                    icon: 'warning',
                    showCancelButton: true,
                    confirmButtonColor: '#007A87',
                    cancelButtonColor: '#6B7280',
                    confirmButtonText: 'Ya, ubah',
                    cancelButtonText: 'Batal',
                }).then((result) => {
                    if (result.isConfirmed) {
                        document.getElementById('input-status').value = statusBaru;
                        document.getElementById('form-status').submit();
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
