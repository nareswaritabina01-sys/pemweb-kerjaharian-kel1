@extends('layouts.app')

@section('content')
    <div class="mb-6">
        <a href="{{ route('pencari-kerja.lowongan.index') }}"
            class="text-xs font-bold text-primary hover:underline flex items-center space-x-1">
            <span>← Kembali ke Daftar Lowongan</span>
        </a>
    </div>

    <div class="grid grid-cols-1 lg:grid-cols-3 gap-6">
        <div class="lg:col-span-2 space-y-6">
            <div class="bg-white border border-gray-200 rounded-2xl p-6 shadow-sm">
                <div class="flex justify-between items-start border-b border-gray-100 pb-6">
                    <div>
                        <h1 class="text-xl font-extrabold text-gray-900">{{ $lowongan->judul }}</h1>
                        <p class="text-sm text-gray-500 mt-1">{{ $lowongan->nama_perusahaan ?? 'Perorangan' }} •
                            {{ $lowongan->lokasi }}</p>
                        <div class="flex flex-wrap gap-2 mt-3">
                            <span class="px-2.5 py-1 bg-teal-50 text-primary text-xs font-bold rounded-lg">
                                Rp {{ number_format($lowongan->upah, 0, ',', '.') }} / {{ $lowongan->satuan_upah }}
                            </span>
                            <span class="px-2.5 py-1 bg-gray-100 text-gray-600 text-xs font-medium rounded-lg">
                                <i class="fa-solid fa-tag mr-1"></i> {{ $lowongan->kategori }}
                            </span>
                            <span class="px-2.5 py-1 bg-gray-100 text-gray-600 text-xs font-medium rounded-lg">
                                <i class="fa-solid fa-user-group mr-1"></i> {{ $lowongan->kuota_pekerja }} Pekerja
                                Dibutuhkan
                            </span>
                        </div>
                    </div>
                    <button type="button" id="btnSimpanLowongan" data-id="{{ $lowongan->id }}"
                        data-tersimpan="{{ $sudahTersimpan ? '1' : '0' }}"
                        class="shrink-0 w-9 h-9 rounded-xl flex items-center justify-center border transition {{ $sudahTersimpan ? 'bg-teal-50 border-primary text-primary' : 'bg-gray-50 border-gray-200 text-gray-400 hover:text-primary hover:border-primary' }}">
                        <i id="iconSimpanLowongan"
                            class="fa-{{ $sudahTersimpan ? 'solid' : 'regular' }} fa-bookmark text-sm"></i>
                    </button>
                </div>

                <div class="py-6 space-y-4">
                    <div>
                        <h3 class="text-sm font-bold text-gray-900">Deskripsi Pekerjaan</h3>
                        <p class="text-xs text-gray-600 mt-2 leading-relaxed">
                            {!! nl2br(e($lowongan->deskripsi)) !!}
                        </p>
                    </div>
                </div>
            </div>

            @if ($lowongan->latitude && $lowongan->longitude)
                <div class="bg-white border border-gray-200 rounded-2xl p-6 shadow-sm">
                    <h3 class="text-sm font-bold text-gray-900 mb-3">Lokasi Pekerjaan</h3>
                    <div id="peta-detail-lowongan" class="w-full h-64 rounded-xl border border-gray-100"></div>
                </div>
            @endif
        </div>

        <div class="space-y-6">
            <div class="bg-white border border-gray-200 rounded-2xl p-6 shadow-sm sticky top-24">
                <h3 class="text-sm font-bold text-gray-900 mb-4">Informasi Tambahan</h3>
                <div class="space-y-4 border-b border-gray-100 pb-4 mb-4">
                    <div class="flex items-center space-x-3 text-xs">
                        <div class="w-8 h-8 bg-gray-50 rounded-lg flex items-center justify-center text-gray-500"><i
                                class="fa-solid fa-wallet"></i></div>
                        <div>
                            <span class="text-gray-400 block text-[10px]">Sistem Upah</span>
                            <span class="font-bold text-gray-800">{{ ucfirst($lowongan->satuan_upah) }}</span>
                        </div>
                    </div>
                    <div class="flex items-center space-x-3 text-xs">
                        <div class="w-8 h-8 bg-gray-50 rounded-lg flex items-center justify-center text-gray-500"><i
                                class="fa-solid fa-user-group"></i></div>
                        <div>
                            <span class="text-gray-400 block text-[10px]">Kuota Pekerja</span>
                            <span class="font-bold text-gray-800">
                                Butuh {{ $lowongan->kuota_pekerja }} Orang
                                @if ($lowongan->sisa_kuota > 0)
                                    (Sisa {{ $lowongan->sisa_kuota }} slot)
                                @else
                                    (Kuota Penuh)
                                @endif
                            </span>
                        </div>
                    </div>
                    <div class="flex items-center space-x-3 text-xs">
                        <div class="w-8 h-8 bg-gray-50 rounded-lg flex items-center justify-center text-gray-500"><i
                                class="fa-solid fa-building"></i></div>
                        <div>
                            <span class="text-gray-400 block text-[10px]">Pemberi Kerja</span>
                            <span class="font-bold text-gray-800">{{ $lowongan->pemberiKerja->nama }}</span>
                        </div>
                    </div>
                </div>

                @if ($sudahMelamar)
                    <button disabled
                        class="w-full bg-gray-200 text-gray-500 font-bold py-3 rounded-xl text-xs cursor-not-allowed">
                        <i class="fa-solid fa-check mr-1"></i> Anda Sudah Melamar
                    </button>
                @elseif ($lowongan->status !== 'dibuka' || $lowongan->sisa_kuota <= 0)
                    <button disabled
                        class="w-full bg-gray-200 text-gray-500 font-bold py-3 rounded-xl text-xs cursor-not-allowed">
                        Lowongan Sudah Ditutup
                    </button>
                @else
                    <button id="openModalBtn"
                        class="w-full bg-primary hover:bg-primary-hover text-white font-bold py-3 rounded-xl text-xs transition shadow-sm">
                        Lamar Pekerjaan Ini
                    </button>
                @endif
            </div>
        </div>
    </div>

    @unless ($sudahMelamar || $lowongan->status !== 'dibuka' || $lowongan->sisa_kuota <= 0)
        <div id="applyModal" class="fixed inset-0 z-[9999] overflow-y-auto hidden">
            <div class="flex items-center justify-center min-h-screen px-4 pt-4 pb-20 text-center sm:block sm:p-0">
                <div class="fixed inset-0 z-0 transition-opacity bg-gray-900/50 backdrop-blur-sm" id="closeModalBg"></div>
                <span class="hidden sm:inline-block sm:align-middle sm:h-screen">&#8203;</span>

                <div <div
                    class="relative z-10 inline-block overflow-hidden text-left align-bottom transition-all transform bg-white rounded-2xl shadow-xl sm:my-8 sm:align-middle sm:max-w-lg sm:w-full border border-gray-100">
                    <div class="bg-white px-6 py-5 border-b border-gray-100 flex justify-between items-center">
                        <div>
                            <h3 class="text-sm font-bold text-gray-900">Kirim Lamaran Kerja</h3>
                            <p class="text-[11px] text-gray-500 mt-0.5">{{ $lowongan->judul }} •
                                {{ $lowongan->nama_perusahaan ?? 'Perorangan' }}</p>
                        </div>
                        <button type="button" id="closeModalIcon" class="text-gray-400 hover:text-gray-600"><i
                                class="fa-solid fa-xmark text-base"></i></button>
                    </div>

                    <form action="{{ route('pencari-kerja.lamaran.store', $lowongan) }}" method="POST" class="p-6 space-y-4">
                        @csrf
                        <div>
                            <label class="block text-[11px] font-bold text-gray-400 uppercase tracking-wider mb-1.5">Pesan
                                Singkat Untuk Penyedia Kerja</label>
                            <textarea name="pesan" rows="4"
                                placeholder="Contoh: Halo, saya berpengalaman di bidang ini dan siap bekerja mulai besok..."
                                class="w-full p-3 bg-gray-50 border border-gray-200 rounded-xl text-xs focus:outline-none focus:ring-2 focus:ring-primary focus:bg-white transition">{{ old('pesan') }}</textarea>
                            @error('pesan')
                                <p class="text-[11px] text-red-500 mt-1">{{ $message }}</p>
                            @enderror
                        </div>

                        <div class="p-3 border border-teal-100 bg-teal-50/50 rounded-xl flex items-center space-x-2.5">
                            <div class="text-primary"><i class="fa-solid fa-circle-info text-base"></i></div>
                            <p class="text-[11px] text-gray-600">Nama, nomor telepon, dan profil Anda akan otomatis terlihat
                                oleh pemberi kerja setelah lamaran dikirim.</p>
                        </div>

                        <div class="pt-4 border-t border-gray-100 flex justify-end space-x-2 text-xs font-bold">
                            <button type="button" id="cancelModalBtn"
                                class="px-4 py-2.5 bg-gray-100 text-gray-700 rounded-xl hover:bg-gray-200 transition">Batal</button>
                            <button type="submit"
                                class="px-5 py-2.5 bg-primary text-white rounded-xl hover:bg-primary-hover transition">Kirim
                                Lamaran Sekarang</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    @endunless

    @push('scripts')
        <link rel="stylesheet" href="https://unpkg.com/leaflet@1.9.4/dist/leaflet.css"
            integrity="sha256-p4NxAoJBhIIN+hmNHrzRCf9tD/miZyoHS5obTRR9BMY=" crossorigin="" />
        <script src="https://unpkg.com/leaflet@1.9.4/dist/leaflet.js"
            integrity="sha256-20nQCchB9co0qIjJZRGuk2/Z9VM+kNiyxNV1lvTlZBo=" crossorigin=""></script>

        <script>
            const modal = document.getElementById('applyModal');
            const openBtn = document.getElementById('openModalBtn');

            if (modal && openBtn) {
                const closeIcon = document.getElementById('closeModalIcon');
                const closeBg = document.getElementById('closeModalBg');
                const cancelBtn = document.getElementById('cancelModalBtn');

                function toggleModal() {
                    modal.classList.toggle('hidden');
                    document.body.classList.toggle('overflow-hidden');
                }

                openBtn.addEventListener('click', toggleModal);
                if (closeIcon) closeIcon.addEventListener('click', toggleModal);
                if (closeBg) closeBg.addEventListener('click', toggleModal);
                if (cancelBtn) cancelBtn.addEventListener('click', toggleModal);
            }

            @if ($lowongan->latitude && $lowongan->longitude)
                const petaDetail = L.map('peta-detail-lowongan').setView([{{ $lowongan->latitude }},
                    {{ $lowongan->longitude }}
                ], 15);
                L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
                    attribution: '&copy; OpenStreetMap contributors'
                }).addTo(petaDetail);
                L.marker([{{ $lowongan->latitude }}, {{ $lowongan->longitude }}])
                    .addTo(petaDetail)
                    .bindPopup(@json($lowongan->judul));
            @endif

            const btnSimpan = document.getElementById('btnSimpanLowongan');
            if (btnSimpan) {
                btnSimpan.addEventListener('click', function() {
                    const idLowongan = this.dataset.id;
                    const icon = document.getElementById('iconSimpanLowongan');

                    fetch(`/pencari-kerja/lowongan/${idLowongan}/simpan`, {
                            method: 'POST',
                            headers: {
                                'Content-Type': 'application/json',
                                'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content,
                            },
                        })
                        .then(res => res.json())
                        .then(data => {
                            if (!data.sukses) return;

                            if (data.tersimpan) {
                                btnSimpan.classList.add('bg-teal-50', 'border-primary', 'text-primary');
                                btnSimpan.classList.remove('bg-gray-50', 'border-gray-200', 'text-gray-400');
                                icon.classList.remove('fa-regular');
                                icon.classList.add('fa-solid');
                            } else {
                                btnSimpan.classList.remove('bg-teal-50', 'border-primary', 'text-primary');
                                btnSimpan.classList.add('bg-gray-50', 'border-gray-200', 'text-gray-400');
                                icon.classList.remove('fa-solid');
                                icon.classList.add('fa-regular');
                            }
                        });
                });
            }
        </script>
    @endpush
@endsection
