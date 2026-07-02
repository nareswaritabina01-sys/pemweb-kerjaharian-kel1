<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Daftar Akun - Kerja Harian</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
</head>
<body class="bg-[#f8fafc] text-gray-800 font-sans min-h-screen flex items-center justify-center p-4">
    <div class="w-full max-w-md bg-white border border-gray-200 rounded-3xl p-8 shadow-sm">
        <div class="text-center mb-8">
            <div class="inline-flex bg-[#f4b41a] text-white p-2 rounded-xl font-bold text-lg w-12 h-12 items-center justify-center shadow-sm mb-3">K</div>
            <h1 class="text-2xl font-bold text-gray-900">Mulai Kerja Harian</h1>
            <p class="text-xs text-gray-500 mt-1">Buat akun Anda sekarang dan temukan ribuan proyek harian di sekitar Anda.</p>
        </div>

        <form action="{{ route('dashboard') }}" method="GET" class="space-y-4">
            <div>
                <label class="block text-xs font-bold text-gray-700 mb-1.5">Nama Lengkap</label>
                <div class="relative">
                    <span class="absolute left-4 top-3 text-gray-400 text-sm"><i class="fa-solid fa-user"></i></span>
                    <input type="text" placeholder="Andi Wijaya" required class="w-full pl-11 pr-4 py-2.5 bg-gray-50 border border-gray-200 rounded-xl text-xs focus:outline-none focus:ring-2 focus:ring-[#007A87] focus:bg-white transition">
                </div>
            </div>

            <div>
                <label class="block text-xs font-bold text-gray-700 mb-1.5">Alamat Email</label>
                <div class="relative">
                    <span class="absolute left-4 top-3 text-gray-400 text-sm"><i class="fa-solid fa-envelope"></i></span>
                    <input type="email" placeholder="nama@email.com" required class="w-full pl-11 pr-4 py-2.5 bg-gray-50 border border-gray-200 rounded-xl text-xs focus:outline-none focus:ring-2 focus:ring-[#007A87] focus:bg-white transition">
                </div>
            </div>

            <div>
                <label class="block text-xs font-bold text-gray-700 mb-1.5">Nomor WhatsApp / HP</label>
                <div class="relative">
                    <span class="absolute left-4 top-3 text-gray-400 text-sm"><i class="fa-solid fa-phone"></i></span>
                    <input type="tel" placeholder="081234567890" required class="w-full pl-11 pr-4 py-2.5 bg-gray-50 border border-gray-200 rounded-xl text-xs focus:outline-none focus:ring-2 focus:ring-[#007A87] focus:bg-white transition">
                </div>
            </div>

            <div>
                <label class="block text-xs font-bold text-gray-700 mb-1.5">Kata Sandi</label>
                <div class="relative">
                    <span class="absolute left-4 top-3 text-gray-400 text-sm"><i class="fa-solid fa-lock"></i></span>
                    <input type="password" placeholder="••••••••" required class="w-full pl-11 pr-4 py-2.5 bg-gray-50 border border-gray-200 rounded-xl text-xs focus:outline-none focus:ring-2 focus:ring-[#007A87] focus:bg-white transition">
                </div>
            </div>

            <div class="flex items-start">
                <input type="checkbox" id="terms" required class="w-4 h-4 text-[#007A87] border-gray-300 rounded focus:ring-[#007A87] mt-0.5">
                <label for="terms" class="ml-2 text-[11px] text-gray-600 selection:bg-transparent leading-relaxed">
                    Saya menyetujui <a href="#" class="text-[#007A87] font-semibold hover:underline">Syarat & Ketentuan</a> serta <a href="#" class="text-[#007A87] font-semibold hover:underline">Kebijakan Privasi</a> KerjaHarian.
                </label>
            </div>

            <button type="submit" class="w-full bg-[#007A87] hover:bg-teal-700 text-white font-bold py-3 rounded-xl shadow-sm transition text-xs mt-2">
                Daftar Akun Baru
            </button>
        </form>

        <div class="text-center mt-6 pt-5 border-t border-gray-100 text-xs text-gray-500">
            Sudah memiliki akun? <a href="#" class="font-bold text-[#007A87] hover:underline">Masuk Aplikasi</a>
        </div>
    </div>
</body>
</html>