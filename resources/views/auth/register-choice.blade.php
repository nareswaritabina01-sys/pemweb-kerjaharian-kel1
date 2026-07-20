<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Daftar Akun - KerjaHarian</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>

<body class="bg-[#f8fafc] font-sans min-h-screen flex items-center justify-center p-4">
    <div class="w-full max-w-md bg-white border border-gray-200 rounded-3xl p-8 shadow-sm">
        <div class="text-center mb-8">
            <div
                class="inline-flex bg-secondary text-white p-2 rounded-2xl font-extrabold text-2xl w-14 h-14 items-center justify-center shadow-sm mb-3">
                K</div>
            <h1 class="text-xl font-extrabold text-gray-950">Mulai Kerja Harian</h1>
            <p class="text-xs text-gray-500 mt-1">Pilih jenis akun yang sesuai dengan kebutuhan Anda.</p>
        </div>

        <div class="flex flex-col gap-3">
            <a href="{{ route('register.pemberi-kerja') }}"
                class="flex items-center gap-3 border border-gray-200 hover:border-primary hover:bg-primary/5 rounded-2xl p-4 transition">
                <span class="w-11 h-11 rounded-xl bg-primary/10 text-primary flex items-center justify-center text-lg">
                    <i class="fa-solid fa-briefcase"></i>
                </span>
                <span>
                    <span class="block text-sm font-bold text-gray-900">Pemberi Kerja</span>
                    <span class="block text-[11px] text-gray-500">Saya ingin membuat lowongan dan mencari pekerja
                        harian</span>
                </span>
            </a>

            <a href="{{ route('register.pencari-kerja') }}"
                class="flex items-center gap-3 border border-gray-200 hover:border-primary hover:bg-primary/5 rounded-2xl p-4 transition">
                <span class="w-11 h-11 rounded-xl bg-primary/10 text-primary flex items-center justify-center text-lg">
                    <i class="fa-solid fa-person-digging"></i>
                </span>
                <span>
                    <span class="block text-sm font-bold text-gray-900">Pencari Kerja</span>
                    <span class="block text-[11px] text-gray-500">Saya ingin mencari dan melamar pekerjaan harian</span>
                </span>
            </a>
        </div>

        <div class="text-center mt-8 pt-6 border-t border-gray-100">
            <p class="text-xs text-gray-500">Sudah punya akun? <a href="{{ route('login') }}"
                    class="font-bold text-primary hover:underline">Masuk di sini</a></p>
        </div>
    </div>
</body>

</html>
