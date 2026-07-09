<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-white">
    <!-- Navbar untuk Guest (Tanpa Sidebar) -->
    <nav class="flex justify-between items-center px-10 py-6">
        <div class="font-bold text-xl text-black">KerjaHarian</div>
        <div class="space-x-6 text-sm">
            <a href="#">Cari Lowongan</a>
            <a href="#">Masuk</a>
            <a href="{{ route('register') }}" class="bg-teal-700 text-white px-6 py-2 rounded-full">Daftar</a>
        </div>
    </nav>
    
    @yield('content')
</body>
</html>