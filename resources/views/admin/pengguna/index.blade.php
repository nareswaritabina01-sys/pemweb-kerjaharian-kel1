@extends('layouts.admin')

@section('title', 'Kelola User')

@section('content')
    <div class="max-w-6xl mx-auto">
        <div class="mb-6">
            <h1 class="text-2xl font-bold text-gray-900">Kelola User</h1>
            <p class="text-gray-600 text-sm">Kelola akun Pemberi Kerja dan Pencari Kerja.</p>
        </div>

        {{-- Filter --}}
        <form action="{{ route('admin.pengguna.index') }}" method="GET"
            class="bg-white rounded-2xl border border-gray-100 shadow-sm p-5 mb-6 flex flex-col md:flex-row gap-3">
            <input type="text" name="cari" value="{{ $filter['cari'] ?? '' }}" placeholder="Cari nama atau email..."
                class="flex-1 border border-gray-200 rounded-xl px-4 py-2.5 text-sm focus:ring-2 focus:ring-primary focus:border-primary outline-none">

            <select name="role"
                class="border border-gray-200 rounded-xl px-4 py-2.5 text-sm focus:ring-2 focus:ring-primary focus:border-primary outline-none">
                <option value="">Semua Role</option>
                <option value="pemberi_kerja" {{ ($filter['role'] ?? '') === 'pemberi_kerja' ? 'selected' : '' }}>Pemberi
                    Kerja</option>
                <option value="pencari_kerja" {{ ($filter['role'] ?? '') === 'pencari_kerja' ? 'selected' : '' }}>Pencari
                    Kerja</option>
            </select>

            <select name="status_akun"
                class="border border-gray-200 rounded-xl px-4 py-2.5 text-sm focus:ring-2 focus:ring-primary focus:border-primary outline-none">
                <option value="">Semua Status</option>
                <option value="aktif" {{ ($filter['status_akun'] ?? '') === 'aktif' ? 'selected' : '' }}>Aktif</option>
                <option value="nonaktif" {{ ($filter['status_akun'] ?? '') === 'nonaktif' ? 'selected' : '' }}>Nonaktif
                </option>
                <option value="banned" {{ ($filter['status_akun'] ?? '') === 'banned' ? 'selected' : '' }}>Banned</option>
            </select>

            <button type="submit"
                class="bg-primary hover:bg-primary-hover text-white font-bold px-5 py-2.5 rounded-full text-sm transition flex items-center gap-2 justify-center">
                <i class="fa-solid fa-magnifying-glass"></i> Filter
            </button>

            @if (($filter['cari'] ?? '') || ($filter['role'] ?? '') || ($filter['status_akun'] ?? ''))
                <a href="{{ route('admin.pengguna.index') }}"
                    class="bg-gray-100 hover:bg-gray-200 text-gray-700 font-bold px-5 py-2.5 rounded-full text-sm transition flex items-center gap-2 justify-center">
                    Reset
                </a>
            @endif
        </form>

        <div class="bg-white rounded-2xl border border-gray-100 shadow-sm overflow-hidden">
            <table class="w-full text-sm">
                <thead>
                    <tr class="bg-gray-50 border-b border-gray-100 text-left text-[11px] text-gray-500 uppercase">
                        <th class="px-6 py-3 font-bold">Nama</th>
                        <th class="px-6 py-3 font-bold">Email</th>
                        <th class="px-6 py-3 font-bold">Role</th>
                        <th class="px-6 py-3 font-bold text-center">Status</th>
                        <th class="px-6 py-3 font-bold text-right">Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse ($penggunaList as $pengguna)
                        <tr class="border-b border-gray-50 last:border-0 hover:bg-gray-50/50">
                            <td class="px-6 py-4 font-semibold text-gray-800">
                                <a href="{{ route('admin.pengguna.show', $pengguna->id) }}" class="hover:text-primary">
                                    {{ $pengguna->nama }}
                                </a>
                            </td>
                            <td class="px-6 py-4 text-gray-600">{{ $pengguna->email }}</td>
                            <td class="px-6 py-4 text-gray-600">
                                {{ $pengguna->isPemberiKerja() ? 'Pemberi Kerja' : 'Pencari Kerja' }}
                            </td>
                            <td class="px-6 py-4 text-center">
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
                            </td>
                            <td class="px-6 py-4">
                                <div class="flex justify-end gap-2">
                                    @foreach (['aktif' => 'Aktif', 'nonaktif' => 'Nonaktif', 'banned' => 'Banned'] as $nilai => $label)
                                        @if ($pengguna->status_akun !== $nilai)
                                            <button type="button"
                                                onclick="konfirmasiUbahStatus({{ $pengguna->id }}, '{{ $nilai }}', '{{ $pengguna->nama }}')"
                                                class="bg-gray-100 hover:bg-gray-200 text-gray-700 font-bold py-2 px-3 rounded-xl text-xs transition">
                                                {{ $label }}
                                            </button>
                                        @endif
                                    @endforeach
                                    <form id="form-status-{{ $pengguna->id }}"
                                        action="{{ route('admin.pengguna.update-status', $pengguna->id) }}" method="POST"
                                        class="hidden">
                                        @csrf
                                        @method('PATCH')
                                        <input type="hidden" name="status_akun" id="input-status-{{ $pengguna->id }}">
                                    </form>
                                </div>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="5" class="px-6 py-16 text-center text-gray-400">
                                <i class="fa-solid fa-users text-3xl mb-3"></i>
                                <p class="text-sm">Belum ada user ditemukan.</p>
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>

        <div class="mt-6">
            {{ $penggunaList->links() }}
        </div>
    </div>

    @push('scripts')
        <script>
            function konfirmasiUbahStatus(id, statusBaru, nama) {
                Swal.fire({
                    title: `Ubah status ${nama}?`,
                    text: `Status akun akan diubah menjadi "${statusBaru}".`,
                    icon: 'warning',
                    showCancelButton: true,
                    confirmButtonColor: '#007A87',
                    cancelButtonColor: '#6B7280',
                    confirmButtonText: 'Ya, ubah',
                    cancelButtonText: 'Batal',
                }).then((result) => {
                    if (result.isConfirmed) {
                        document.getElementById('input-status-' + id).value = statusBaru;
                        document.getElementById('form-status-' + id).submit();
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
