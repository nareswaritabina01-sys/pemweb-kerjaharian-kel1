<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Daftar Pemberi Kerja - KerjaHarian</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>

<body class="bg-[#f8fafc] text-gray-800 font-sans min-h-screen flex items-center justify-center p-4">
    <div class="w-full max-w-md bg-white border border-gray-200 rounded-3xl p-8 shadow-sm">
        <div class="text-center mb-8">
            <div
                class="inline-flex bg-secondary text-white p-2 rounded-xl font-bold text-lg w-12 h-12 items-center justify-center shadow-sm mb-3">
                <i class="fa-solid fa-briefcase"></i>
            </div>
            <h1 class="text-2xl font-bold text-gray-900">Daftar sebagai Pemberi Kerja</h1>
            <p class="text-xs text-gray-500 mt-1">Buat lowongan dan temukan pekerja harian di sekitar Anda.</p>
        </div>

        <form action="{{ route('register.pemberi-kerja.process') }}" method="POST" class="space-y-4">
            @csrf

            <div>
                <label class="block text-xs font-bold text-gray-700 mb-1.5">Nama Lengkap</label>
                <div class="relative">
                    <span class="absolute left-4 top-3 text-gray-400 text-sm"><i class="fa-solid fa-user"></i></span>
                    <input type="text" name="nama" value="{{ old('nama') }}" placeholder="Andi Wijaya" required
                        class="w-full pl-11 pr-4 py-2.5 bg-gray-50 border border-gray-200 rounded-xl text-xs focus:outline-none focus:ring-2 focus:ring-primary focus:bg-white transition">
                </div>
                @error('nama')
                    <span class="text-red-500 text-[10px] mt-1 block">{{ $message }}</span>
                @enderror
            </div>

            <div>
                <label class="block text-xs font-bold text-gray-700 mb-1.5">Alamat Email</label>
                <div class="relative">
                    <span class="absolute left-4 top-3 text-gray-400 text-sm"><i
                            class="fa-solid fa-envelope"></i></span>
                    <input type="email" name="email" value="{{ old('email') }}" placeholder="nama@email.com"
                        required
                        class="w-full pl-11 pr-4 py-2.5 bg-gray-50 border border-gray-200 rounded-xl text-xs focus:outline-none focus:ring-2 focus:ring-primary focus:bg-white transition">
                </div>
                @error('email')
                    <span class="text-red-500 text-[10px] mt-1 block">{{ $message }}</span>
                @enderror
            </div>

            <div>
                <label class="block text-xs font-bold text-gray-700 mb-1.5">Nomor WhatsApp / HP</label>
                <div class="relative">
                    <span class="absolute left-4 top-3 text-gray-400 text-sm"><i class="fa-solid fa-phone"></i></span>
                    <input type="tel" name="no_telepon" value="{{ old('no_telepon') }}" placeholder="081234567890"
                        class="w-full pl-11 pr-4 py-2.5 bg-gray-50 border border-gray-200 rounded-xl text-xs focus:outline-none focus:ring-2 focus:ring-primary focus:bg-white transition">
                </div>
                @error('no_telepon')
                    <span class="text-red-500 text-[10px] mt-1 block">{{ $message }}</span>
                @enderror
            </div>

            <div>
                <label class="block text-xs font-bold text-gray-700 mb-1.5">Alamat</label>
                <textarea name="alamat" rows="2" placeholder="Alamat domisili / lokasi usaha"
                    class="w-full px-4 py-2.5 bg-gray-50 border border-gray-200 rounded-xl text-xs focus:outline-none focus:ring-2 focus:ring-primary focus:bg-white transition">{{ old('alamat') }}</textarea>
                @error('alamat')
                    <span class="text-red-500 text-[10px] mt-1 block">{{ $message }}</span>
                @enderror
            </div>

            <div>
                <label class="block text-xs font-bold text-gray-700 mb-1.5">Kata Sandi</label>
                <div class="relative">
                    <span class="absolute left-4 top-3 text-gray-400 text-sm"><i class="fa-solid fa-lock"></i></span>
                    <input type="password" name="password" placeholder="••••••••" required
                        class="w-full pl-11 pr-4 py-2.5 bg-gray-50 border border-gray-200 rounded-xl text-xs focus:outline-none focus:ring-2 focus:ring-primary focus:bg-white transition">
                </div>
                @error('password')
                    <span class="text-red-500 text-[10px] mt-1 block">{{ $message }}</span>
                @enderror
            </div>

            <div>
                <label class="block text-xs font-bold text-gray-700 mb-1.5">Konfirmasi Kata Sandi</label>
                <div class="relative">
                    <span class="absolute left-4 top-3 text-gray-400 text-sm"><i class="fa-solid fa-lock"></i></span>
                    <input type="password" name="password_confirmation" placeholder="••••••••" required
                        class="w-full pl-11 pr-4 py-2.5 bg-gray-50 border border-gray-200 rounded-xl text-xs focus:outline-none focus:ring-2 focus:ring-primary focus:bg-white transition">
                </div>
            </div>

            <div class="flex items-start">
                <input type="checkbox" id="terms" required
                    class="w-4 h-4 text-primary border-gray-300 rounded focus:ring-primary mt-0.5">
                <label for="terms" class="ml-2 text-[11px] text-gray-600 leading-relaxed">
                    Saya menyetujui <a href="#" class="text-primary font-semibold hover:underline">Syarat &
                        Ketentuan</a> serta <a href="#"
                        class="text-primary font-semibold hover:underline">Kebijakan Privasi</a> KerjaHarian.
                </label>
            </div>

            <button type="submit"
                class="w-full bg-primary hover:bg-primary-hover text-white font-bold py-3 rounded-xl shadow-sm transition text-xs mt-2">
                Daftar Akun Baru
            </button>
        </form>

        <div class="text-center mt-6 pt-5 border-t border-gray-100 text-xs text-gray-500">
            Sudah memiliki akun? <a href="{{ route('login') }}" class="font-bold text-primary hover:underline">Masuk
                Aplikasi</a>
        </div>
    </div>
</body>

</html>
