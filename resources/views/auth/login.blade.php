<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Masuk - KerjaHarian</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
</head>
<body class="bg-[#f8fafc] min-h-screen flex items-center justify-center p-4">
    <div class="bg-white border border-gray-200 rounded-3xl p-8 shadow-sm w-full max-w-md">
        <div class="text-center mb-8">
            <div class="bg-[#f4b41a] text-white p-2 rounded-2xl font-bold text-2xl w-14 h-14 flex items-center justify-center shadow-md mx-auto mb-3">K</div>
            <h1 class="text-xl font-extrabold text-gray-950">Selamat Datang Kembali</h1>
            <p class="text-gray-500 text-xs mt-1">Masuk ke akun KerjaHarian milikmu untuk mengelola proyek dan lamaran harian.</p>
        </div>

        <form action="{{ route('login.process') }}" method="POST" class="space-y-4">
            @csrf
            
            <div>
                <label class="block text-[11px] font-bold text-gray-400 uppercase tracking-wider mb-1.5">Alamat Email</label>
                <div class="relative">
                    <span class="absolute left-4 top-3.5 text-gray-400 text-xs"><i class="fa-solid fa-envelope"></i></span>
                    <input type="email" name="email" value="{{ old('email') }}" placeholder="contoh@email.com" class="w-full pl-11 pr-4 py-2.5 bg-gray-50 border border-gray-200 rounded-xl text-xs focus:outline-none focus:ring-2 focus:ring-[#007A87] focus:bg-white transition" required>
                </div>
                @error('email')
                    <span class="text-red-500 text-[10px] mt-1 block">{{ $message }}</span>
                @enderror
            </div>

            <div>
                <div class="flex justify-between items-center mb-1.5">
                    <label class="block text-[11px] font-bold text-gray-400 uppercase tracking-wider">Kata Sandi</label>
                    <a href="#" class="text-[11px] font-bold text-[#007A87] hover:underline">Lupa Sandi?</a>
                </div>
                <div class="relative">
                    <span class="absolute left-4 top-3.5 text-gray-400 text-xs"><i class="fa-solid fa-lock"></i></span>
                    <input type="password" name="password" placeholder="••••••••" class="w-full pl-11 pr-4 py-2.5 bg-gray-50 border border-gray-200 rounded-xl text-xs focus:outline-none focus:ring-2 focus:ring-[#007A87] focus:bg-white transition" required>
                </div>
            </div>

            <div class="flex items-center pt-1">
                <input type="checkbox" name="remember" id="remember" class="w-4 h-4 text-[#007A87] border-gray-300 rounded focus:ring-[#007A87] bg-gray-50">
                <label for="remember" class="ml-2 text-xs text-gray-600 cursor-pointer select-none">Ingat saya di perangkat ini</label>
            </div>

            <button type="submit" class="w-full bg-[#007A87] hover:bg-teal-700 text-white font-bold py-3 rounded-xl text-xs transition shadow-sm mt-2">
                Masuk Sekarang
            </button>
        </form>

        <div class="text-center mt-8 pt-6 border-t border-gray-100">
            <p class="text-xs text-gray-500">Belum punya akun KerjaHarian? <a href="{{ route('register') }}" class="font-bold text-[#007A87] hover:underline">Daftar Sekarang</a></p>
        </div>
    </div>
</body>
</html>