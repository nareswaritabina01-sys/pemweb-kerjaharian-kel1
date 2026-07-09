<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Masuk - KerjaHarian</title>

    <script src="https://cdn.tailwindcss.com"></script>

    <link rel="stylesheet"
          href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
</head>

<body class="bg-[#f8fafc] min-h-screen flex items-center justify-center p-4">

    @if(session('success'))
        <div class="fixed top-5 right-5 bg-green-500 text-white px-5 py-3 rounded-xl shadow-lg z-50">
            {{ session('success') }}
        </div>
    @endif

    <div class="bg-white border border-gray-200 rounded-3xl p-8 shadow-sm w-full max-w-md">

        <div class="text-center mb-8">
            <div class="bg-[#f4b41a] text-white p-2 rounded-2xl font-bold text-2xl w-14 h-14 flex items-center justify-center shadow-md mx-auto mb-3">
                K
            </div>

            <h1 class="text-xl font-extrabold text-gray-900">
                Selamat Datang Kembali
            </h1>

            <p class="text-gray-500 text-xs mt-1">
                Masuk ke akun KerjaHarian milikmu untuk mengelola proyek dan lamaran harian.
            </p>
        </div>

        @if($errors->any())
            <div class="mb-4 rounded-xl border border-red-300 bg-red-100 p-3 text-sm text-red-700">
                {{ $errors->first() }}
            </div>
        @endif

        <form action="{{ route('login.process') }}" method="POST" class="space-y-4">

            @csrf

            <div>

                <label class="block text-[11px] font-bold text-gray-400 uppercase tracking-wider mb-1.5">
                    Alamat Email
                </label>

                <div class="relative">

                    <span class="absolute left-4 top-3.5 text-gray-400 text-xs">
                        <i class="fa-solid fa-envelope"></i>
                    </span>

                    <input
                        type="email"
                        name="email"
                        value="{{ old('email') }}"
                        autocomplete="email"
                        placeholder="contoh@email.com"
                        class="w-full pl-11 pr-4 py-2.5 bg-gray-50 border border-gray-200 rounded-xl text-xs focus:outline-none focus:ring-2 focus:ring-[#007A87] focus:bg-white transition"
                        required>

                </div>

                @error('email')
                    <p class="text-red-500 text-xs mt-2">
                        {{ $message }}
                    </p>
                @enderror

            </div>

            <div>

                <div class="flex justify-between items-center mb-1.5">

                    <label class="block text-[11px] font-bold text-gray-400 uppercase tracking-wider">
                        Kata Sandi
                    </label>

                    <a href="#" class="text-[11px] font-bold text-[#007A87] hover:underline">
                        Lupa Sandi?
                    </a>

                </div>

                <div class="relative">

                    <span class="absolute left-4 top-3.5 text-gray-400 text-xs">
                        <i class="fa-solid fa-lock"></i>
                    </span>

                    <input
                        type="password"
                        id="password"
                        name="password"
                        autocomplete="current-password"
                        placeholder="••••••••"
                        class="w-full pl-11 pr-12 py-2.5 bg-gray-50 border border-gray-200 rounded-xl text-xs focus:outline-none focus:ring-2 focus:ring-[#007A87] focus:bg-white transition"
                        required>

                    <button
                        type="button"
                        id="togglePassword"
                        class="absolute right-4 top-3.5 text-gray-400 hover:text-gray-600">

                        <i id="eyeIcon" class="fa-solid fa-eye-slash text-xs"></i>

                    </button>

                </div>

                @error('password')
                    <p class="text-red-500 text-xs mt-2">
                        {{ $message }}
                    </p>
                @enderror

            </div>

            <div class="flex items-center">

                <input
                    type="checkbox"
                    name="remember"
                    id="remember"
                    class="rounded border-gray-300 text-[#007A87] focus:ring-[#007A87]">

                <label
                    for="remember"
                    class="ml-2 text-xs text-gray-600 cursor-pointer">

                    Ingat saya di perangkat ini

                </label>

            </div>

            <button
                type="submit"
                class="w-full bg-[#007A87] hover:bg-teal-700 text-white font-bold py-3 rounded-xl text-xs transition shadow-sm">

                Masuk Sekarang

            </button>

        </form>

        <div class="text-center mt-8 pt-6 border-t border-gray-100">

            <p class="text-xs text-gray-500">

                Belum punya akun KerjaHarian?

                <a href="{{ route('register') }}"
                   class="font-bold text-[#007A87] hover:underline">

                    Daftar Sekarang

                </a>

            </p>

        </div>

    </div>

<script>

const togglePassword = document.getElementById('togglePassword');

const password = document.getElementById('password');

const eyeIcon = document.getElementById('eyeIcon');

togglePassword.addEventListener('click', function () {

    if(password.type === 'password')
    {
        password.type='text';

        eyeIcon.classList.remove('fa-eye-slash');
        eyeIcon.classList.add('fa-eye');
    }
    else
    {
        password.type='password';

        eyeIcon.classList.remove('fa-eye');
        eyeIcon.classList.add('fa-eye-slash');
    }

});

</script>

</body>
</html>