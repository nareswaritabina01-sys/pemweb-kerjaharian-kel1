@extends('layouts.app')

@section('content')
<div class="mb-6">
    <a href="{{ route('jobs.index') }}" class="text-xs font-bold text-[#007A87] hover:underline flex items-center space-x-1">
        <span>← Kembali ke Daftar Lowongan</span>
    </a>
</div>

<div class="grid grid-cols-1 lg:grid-cols-3 gap-6">
    <div class="lg:col-span-2 space-y-6">
        <div class="bg-white border border-gray-200 rounded-2xl p-6 shadow-sm">
            <div class="flex justify-between items-start border-b border-gray-100 pb-6">
                <div>
                    <h1 class="text-xl font-extrabold text-gray-900">Tukang Kayu Pembuatan Lemari</h1>
                    <p class="text-sm text-gray-500 mt-1">Maju Jaya Furniture • Cimahi Selatan</p>
                    <div class="flex flex-wrap gap-2 mt-3">
                        <span class="px-2.5 py-1 bg-teal-50 text-[#007A87] text-xs font-bold rounded-lg">Rp 150.000 / hari</span>
                        <span class="px-2.5 py-1 bg-gray-100 text-gray-600 text-xs font-medium rounded-lg"><i class="fa-solid fa-calendar-days mr-1"></i> Kontrak 3 Hari</span>
                        <span class="px-2.5 py-1 bg-gray-100 text-gray-600 text-xs font-medium rounded-lg"><i class="fa-solid fa-clock mr-1"></i> Mulai Besok</span>
                    </div>
                </div>
                <button class="w-10 h-10 bg-gray-50 text-gray-400 hover:text-red-500 rounded-xl flex items-center justify-center border border-gray-200 transition">
                    <i class="fa-regular fa-bookmark text-lg"></i>
                </button>
            </div>

            <div class="py-6 space-y-4">
                <div>
                    <h3 class="text-sm font-bold text-gray-900">Deskripsi Pekerjaan</h3>
                    <p class="text-xs text-gray-600 mt-2 leading-relaxed">
                        Kami sedang membutuhkan tukang kayu harian tambahan untuk mempercepat proyek pembuatan lemari pakaian kustom berbahan plywood/multiplek. Pekerjaan difokuskan pada tahap akhir perakitan, penghalusan, dan pemasangan lapisan HPL pada pintu serta laci lemari.
                    </p>
                </div>

                <div>
                    <h3 class="text-sm font-bold text-gray-900">Tanggung Jawab</h3>
                    <ul class="list-disc list-inside text-xs text-gray-600 mt-2 space-y-1.5 market:text-[#007A87]">
                        <li>Memotong dan merakit komponen lemari sesuai ukuran blueprint.</li>
                        <li>Melakukan pengeleman dan penempelan HPL dengan rapi tanpa gelembung udara.</li>
                        <li>Memasang engsel sendok, rel laci, dan handle pintu dengan presisi.</li>
                        <li>Membersihkan sisa-sisa lem dan merapikan area kerja setelah selesai.</li>
                    </ul>
                </div>

                <div>
                    <h3 class="text-sm font-bold text-gray-900">Kualifikasi Pekerja</h3>
                    <ul class="list-disc list-inside text-xs text-gray-600 mt-2 space-y-1.5">
                        <li>Memiliki pengalaman minimal 2 tahun sebagai tukang kayu atau pengerjaan interior Furniture.</li>
                        <li>Wajib membawa peralatan dasar sendiri (handsaw, meteran, pasah manual, sekrap). Mesin potong besar disediakan di workshop.</li>
                        <li>Mampu bekerja secara cepat, teliti, dan komunikatif dengan kepala bengkel.</li>
                        <li>Sehat jasmani dan sudah melakukan vaksinasi dasar.</li>
                    </ul>
                </div>
            </div>
        </div>
    </div>

    <div class="space-y-6">
        <div class="bg-white border border-gray-200 rounded-2xl p-6 shadow-sm sticky top-24">
            <h3 class="text-sm font-bold text-gray-900 mb-4">Informasi Tambahan</h3>
            <div class="space-y-4 border-b border-gray-100 pb-4 mb-4">
                <div class="flex items-center space-x-3 text-xs">
                    <div class="w-8 h-8 bg-gray-50 rounded-lg flex items-center justify-center text-gray-500"><i class="fa-solid fa-wallet"></i></div>
                    <div>
                        <span class="text-gray-400 block text-[10px]">Sistem Pembayaran</span>
                        <span class="font-bold text-gray-800">Dibayar Harian (Setiap Sore)</span>
                    </div>
                </div>
                <div class="flex items-center space-x-3 text-xs">
                    <div class="w-8 h-8 bg-gray-50 rounded-lg flex items-center justify-center text-gray-500"><i class="fa-solid fa-bowl-food"></i></div>
                    <div>
                        <span class="text-gray-400 block text-[10px]">Fasilitas Tambahan</span>
                        <span class="font-bold text-gray-800">Makan Siang Disediakan</span>
                    </div>
                </div>
                <div class="flex items-center space-x-3 text-xs">
                    <div class="w-8 h-8 bg-gray-50 rounded-lg flex items-center justify-center text-gray-500"><i class="fa-solid fa-user-group"></i></div>
                    <div>
                        <span class="text-gray-400 block text-[10px]">Kuota Pekerja</span>
                        <span class="font-bold text-gray-800">Butuh 2 Orang (Sisa 1 slot lagi)</span>
                    </div>
                </div>
            </div>
            <button id="openModalBtn" class="w-full bg-[#007A87] hover:bg-teal-700 text-white font-bold py-3 rounded-xl text-xs transition shadow-sm">
                Lamar Pekerjaan Ini
            </button>
        </div>
    </div>
</div>

<div id="applyModal" class="fixed inset-0 z-50 overflow-y-auto hidden">
    <div class="flex items-center justify-center min-h-screen px-4 pt-4 pb-20 text-center sm:block sm:p-0">
        <div class="fixed inset-0 transition-opacity bg-gray-900/50 backdrop-blur-sm" id="closeModalBg"></div>
        <span class="hidden sm:inline-block sm:align-middle sm:h-screen">&#8203;</span>
        
        <div class="inline-block overflow-hidden text-left align-bottom transition-all transform bg-white rounded-2xl shadow-xl sm:my-8 sm:align-middle sm:max-w-lg sm:w-full border border-gray-100">
            <div class="bg-white px-6 py-5 border-b border-gray-100 flex justify-between items-center">
                <div>
                    <h3 class="text-sm font-bold text-gray-900">Kirim Lamaran Kerja</h3>
                    <p class="text-[11px] text-gray-500 mt-0.5">Tukang Kayu Pembuatan Lemari • Maju Jaya Furniture</p>
                </div>
                <button id="closeModalIcon" class="text-gray-400 hover:text-gray-600"><i class="fa-solid fa-xmark text-base"></i></button>
            </div>
            
            <form action="#" method="POST" class="p-6 space-y-4">
                <div>
                    <label class="block text-[11px] font-bold text-gray-400 uppercase tracking-wider mb-1.5">Pesan Singkat Untuk Penyedia Kerja</label>
                    <textarea rows="4" placeholder="Contoh: Halo Pak, saya Andi. Saya punya alat lengkap dan biasa pasang HPL lemari kustom dengan rapi. Siap langsung kerja besok pagi..." class="w-full p-3 bg-gray-50 border border-gray-200 rounded-xl text-xs focus:outline-none focus:ring-2 focus:ring-[#007A87] focus:bg-white transition" required></textarea>
                </div>

                <div>
                    <label class="block text-[11px] font-bold text-gray-400 uppercase tracking-wider mb-1.5">Dokumen Profil Yang Dilampirkan</label>
                    <div class="p-3 border border-teal-100 bg-teal-50/50 rounded-xl flex items-center justify-between">
                        <div class="flex items-center space-x-2.5">
                            <div class="text-[#007A87]"><i class="fa-solid fa-file-invoice text-base"></i></div>
                            <div>
                                <span class="text-xs font-bold text-gray-800 block">Profil Utama & Berkas KTP</span>
                                <span class="text-[10px] text-gray-500 block">Otomatis dilampirkan dari pengaturan Profil Saya</span>
                            </div>
                        </div>
                        <span class="text-green-600 text-xs"><i class="fa-solid fa-circle-check"></i></span>
                    </div>
                </div>

                <div class="pt-4 border-t border-gray-100 flex justify-end space-x-2 text-xs font-bold">
                    <button type="button" id="cancelModalBtn" class="px-4 py-2.5 bg-gray-100 text-gray-700 rounded-xl hover:bg-gray-200 transition">Batal</button>
                    <button type="submit" class="px-5 py-2.5 bg-[#007A87] text-white rounded-xl hover:bg-teal-700 transition">Kirim Lamaran Sekarang</button>
                </div>
            </form>
        </div>
    </div>
</div>

<script>
    const modal = document.getElementById('applyModal');
    const openBtn = document.getElementById('openModalBtn');
    const closeIcon = document.getElementById('closeModalIcon');
    const closeBg = document.getElementById('closeModalBg');
    const cancelBtn = document.getElementById('cancelModalBtn');

    function toggleModal() {
        modal.classList.toggle('hidden');
        document.body.classList.toggle('overflow-hidden');
    }

    if (openBtn) openBtn.addEventListener('click', toggleModal);
    if (closeIcon) closeIcon.addEventListener('click', toggleModal);
    if (closeBg) closeBg.addEventListener('click', toggleModal);
    if (cancelBtn) cancelBtn.addEventListener('click', toggleModal);
</script>
@endsection