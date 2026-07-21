@extends('layouts.app')

@section('title', 'Lowongan Saya')

@section('content')
    <div class="max-w-7xl mx-auto">
        <div class="flex items-center justify-between mb-6">
            <div>
                <h1 class="text-2xl font-bold text-gray-900">Lowongan Saya</h1>
                <p class="text-gray-600 text-sm">Kelola lowongan pekerjaan yang Anda buat.</p>
            </div>
            <a href="{{ route('pemberi-kerja.lowongan.create') }}"
                class="bg-primary hover:bg-primary-hover text-white font-bold px-5 py-2.5 rounded-full text-sm transition flex items-center gap-2">
                <i class="fa-solid fa-plus"></i> Buat Lowongan
            </a>
        </div>

        {{-- Filter Status --}}
        <div class="flex gap-2 mb-6">
            <a href="{{ route('pemberi-kerja.lowongan.index') }}"
                class="px-4 py-2 rounded-full border text-xs font-semibold transition
                {{ !$status ? 'bg-primary text-white border-primary' : 'bg-white text-gray-600 border-gray-200 hover:border-primary hover:text-primary' }}">
                Semua
            </a>
            <a href="{{ route('pemberi-kerja.lowongan.index', ['status' => 'dibuka']) }}"
                class="px-4 py-2 rounded-full border text-xs font-semibold transition
                {{ $status === 'dibuka' ? 'bg-primary text-white border-primary' : 'bg-white text-gray-600 border-gray-200 hover:border-primary hover:text-primary' }}">
                Dibuka
            </a>
            <a href="{{ route('pemberi-kerja.lowongan.index', ['status' => 'ditutup']) }}"
                class="px-4 py-2 rounded-full border text-xs font-semibold transition
                {{ $status === 'ditutup' ? 'bg-primary text-white border-primary' : 'bg-white text-gray-600 border-gray-200 hover:border-primary hover:text-primary' }}">
                Ditutup
            </a>
        </div>

        {{-- Grid Lowongan --}}
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
            @forelse($lowongan as $job)
                <div
                    class="bg-white rounded-2xl border border-gray-100 shadow-sm overflow-hidden hover:shadow-lg transition">
                    <div class="h-28 bg-teal-50 flex items-center justify-center relative">
                        <i class="fa-solid fa-briefcase text-primary text-2xl"></i>
                        <span
                            class="absolute top-3 right-3 text-[10px] font-bold px-3 py-1 rounded-full
                            {{ $job->status === 'dibuka' ? 'bg-green-100 text-green-700' : 'bg-gray-200 text-gray-600' }}">
                            {{ ucfirst($job->status) }}
                        </span>
                    </div>
                    <div class="p-5">
                        <h3 class="font-bold text-gray-900 text-sm mb-1">{{ $job->judul }}</h3>
                        <p class="text-[11px] text-gray-500 mb-1">
                            <i class="fa-solid fa-location-dot mr-1"></i>{{ $job->lokasi }}
                        </p>
                        <p class="font-bold text-primary text-xs mb-3">
                            Rp {{ number_format($job->upah, 0, ',', '.') }} / {{ $job->satuan_upah }}
                        </p>
                        <div class="flex justify-between items-center text-[10px] text-gray-400 border-t pt-3 mb-4">
                            <span><i class="fa-solid fa-users mr-1"></i>{{ $job->lamaran_count }} pelamar</span>
                            <span><i class="fa-solid fa-user-check mr-1"></i>Sisa {{ $job->sisa_kuota }} slot</span>
                        </div>
                        <div class="flex gap-2">
                            <a href="{{ route('pemberi-kerja.lowongan.show', $job->id) }}"
                                class="flex-1 text-center bg-secondary hover:bg-yellow-500 text-gray-900 font-bold py-2.5 rounded-xl text-xs transition">
                                Lihat Pelamar
                            </a>
                            <a href="{{ route('pemberi-kerja.lowongan.edit', $job->id) }}"
                                class="bg-gray-100 hover:bg-gray-200 text-gray-700 font-bold py-2.5 px-3 rounded-xl text-xs transition">
                                <i class="fa-solid fa-pen"></i>
                            </a>
                            <form action="{{ route('pemberi-kerja.lowongan.toggle-status', $job->id) }}" method="POST"
                                class="inline">
                                @csrf
                                @method('PATCH')
                                <button type="submit"
                                    class="bg-gray-100 hover:bg-gray-200 text-gray-700 font-bold py-2.5 px-3 rounded-xl text-xs transition">
                                    <i class="fa-solid fa-power-off"></i>
                                </button>
                            </form>
                            <button type="button" onclick="konfirmasiHapus({{ $job->id }})"
                                class="bg-red-50 hover:bg-red-100 text-red-600 font-bold py-2.5 px-3 rounded-xl text-xs transition">
                                <i class="fa-solid fa-trash"></i>
                            </button>
                            <form id="form-hapus-{{ $job->id }}"
                                action="{{ route('pemberi-kerja.lowongan.destroy', $job->id) }}" method="POST"
                                class="hidden">
                                @csrf
                                @method('DELETE')
                            </form>
                        </div>
                    </div>
                </div>
            @empty
                <div class="col-span-full text-center py-16 text-gray-400">
                    <i class="fa-solid fa-inbox text-3xl mb-3"></i>
                    <p class="text-sm">Anda belum membuat lowongan.</p>
                </div>
            @endforelse
        </div>

        <div class="mt-8">
            {{ $lowongan->links() }}
        </div>
    </div>

    @push('scripts')
        <script>
            function konfirmasiHapus(id) {
                Swal.fire({
                    title: 'Hapus lowongan ini?',
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
