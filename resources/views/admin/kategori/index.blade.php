@extends('layouts.admin')

@section('title', 'Kelola Kategori')

@section('content')
    <div class="max-w-4xl mx-auto">
        <div class="flex items-center justify-between mb-6">
            <div>
                <h1 class="text-2xl font-bold text-gray-900">Kelola Kategori</h1>
                <p class="text-gray-600 text-sm">Kategori pekerjaan yang tersedia di sistem.</p>
            </div>
            <a href="{{ route('admin.kategori.create') }}"
                class="bg-primary hover:bg-primary-hover text-white font-bold px-5 py-2.5 rounded-full text-sm transition flex items-center gap-2">
                <i class="fa-solid fa-plus"></i> Tambah Kategori
            </a>
        </div>

        <div class="bg-white rounded-2xl border border-gray-100 shadow-sm overflow-hidden">
            <table class="w-full text-sm">
                <thead>
                    <tr class="bg-gray-50 border-b border-gray-100 text-left text-[11px] text-gray-500 uppercase">
                        <th class="px-6 py-3 font-bold">Nama Kategori</th>
                        <th class="px-6 py-3 font-bold text-center">Jumlah Lowongan</th>
                        <th class="px-6 py-3 font-bold text-right">Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse ($kategoriList as $kat)
                        <tr class="border-b border-gray-50 last:border-0 hover:bg-gray-50/50">
                            <td class="px-6 py-4 font-semibold text-gray-800">{{ $kat->nama }}</td>
                            <td class="px-6 py-4 text-center text-gray-600">{{ $kat->lowongan_count }}</td>
                            <td class="px-6 py-4">
                                <div class="flex justify-end gap-2">
                                    <a href="{{ route('admin.kategori.edit', $kat->id) }}"
                                        class="bg-gray-100 hover:bg-gray-200 text-gray-700 font-bold py-2 px-3 rounded-xl text-xs transition">
                                        <i class="fa-solid fa-pen"></i>
                                    </a>
                                    <button type="button" onclick="konfirmasiHapus({{ $kat->id }})"
                                        class="bg-red-50 hover:bg-red-100 text-red-600 font-bold py-2 px-3 rounded-xl text-xs transition">
                                        <i class="fa-solid fa-trash"></i>
                                    </button>
                                    <form id="form-hapus-{{ $kat->id }}"
                                        action="{{ route('admin.kategori.destroy', $kat->id) }}" method="POST"
                                        class="hidden">
                                        @csrf
                                        @method('DELETE')
                                    </form>
                                </div>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="3" class="px-6 py-16 text-center text-gray-400">
                                <i class="fa-solid fa-inbox text-3xl mb-3"></i>
                                <p class="text-sm">Belum ada kategori.</p>
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>

    @push('scripts')
        <script>
            function konfirmasiHapus(id) {
                Swal.fire({
                    title: 'Hapus kategori ini?',
                    text: 'Tindakan ini tidak bisa dibatalkan.',
                    icon: 'warning',
                    showCancelButton: true,
                    confirmButtonColor: '#EF4444',
                    cancelButtonColor: '#6B7280',
                    confirmButtonText: 'Ya, hapus',
                    cancelButtonText: 'Batal',
                }).then((result) => {
                    if (result.isConfirmed) {
                        document.getElementById('form-hapus-' + id).submit();
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
