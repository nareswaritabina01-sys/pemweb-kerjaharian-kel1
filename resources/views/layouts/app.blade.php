<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'KerjaHarian')</title>

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>

<body class="bg-[#f8fafc] text-gray-800 font-sans antialiased">

    {{-- Navbar Atas --}}
    <nav
        class="bg-white border-b border-gray-200 fixed top-0 z-50 w-full px-6 py-3 flex justify-between items-center shadow-sm">
        <div class="flex items-center space-x-2">
            <div
                class="bg-secondary text-white p-2 rounded-lg font-bold text-lg w-10 h-10 flex items-center justify-center shadow-sm">
                K</div>
            <span class="text-xl font-bold text-primary">KerjaHarian</span>
        </div>
        <div class="flex items-center space-x-2 border-l pl-4 border-gray-200">
            <img src="https://ui-avatars.com/api/?name={{ urlencode(auth()->user()->nama ?? 'User') }}&background=007A87&color=fff"
                class="w-8 h-8 rounded-full" alt="Avatar">
            <span class="text-gray-700 hidden md:inline text-sm">Halo, {{ auth()->user()->nama ?? 'User' }}</span>
        </div>
    </nav>

    {{-- Sidebar & Konten --}}
    <div class="flex pt-16">
        <aside
            class="w-64 bg-white h-[calc(100vh-4rem)] border-r border-gray-200 fixed left-0 top-16 overflow-y-auto hidden md:block px-4 py-6">
            <div class="space-y-1">
                <a href="{{ route('pencari-kerja.dashboard') }}"
                    class="flex items-center space-x-3 px-4 py-3 text-sm font-medium rounded-xl {{ request()->routeIs('pencari-kerja.dashboard') ? 'bg-teal-50 text-primary' : 'text-gray-600 hover:bg-gray-50 hover:text-primary' }}">
                    <i class="fa-solid fa-house text-lg"></i>
                    <span>Dashboard</span>
                </a>
                <a href="{{ route('pencari-kerja.lowongan.index') }}"
                    class="flex items-center space-x-3 px-4 py-3 text-sm font-medium rounded-xl {{ request()->routeIs('pencari-kerja.lowongan.*') ? 'bg-teal-50 text-primary' : 'text-gray-600 hover:bg-gray-50 hover:text-primary' }}">
                    <i class="fa-solid fa-magnifying-glass text-lg"></i>
                    <span>Cari Kerja</span>
                </a>
                <a href="{{ route('pencari-kerja.lamaran.index') }}"
                    class="flex items-center space-x-3 px-4 py-3 text-sm font-medium rounded-xl {{ request()->routeIs('pencari-kerja.lamaran.*') ? 'bg-teal-50 text-primary' : 'text-gray-600 hover:bg-gray-50 hover:text-primary' }}">
                    <i class="fa-solid fa-file-invoice text-lg"></i>
                    <span>Lamaran Saya</span>
                </a>
                <a href="{{ route('pencari-kerja.pesan.index') }}"
                    class="flex items-center space-x-3 px-4 py-3 text-sm font-medium rounded-xl {{ request()->routeIs('pencari-kerja.pesan.*') ? 'bg-teal-50 text-primary' : 'text-gray-600 hover:bg-gray-50 hover:text-primary' }}">
                    <i class="fa-solid fa-comment-dots text-lg"></i>
                    <span>Pesan</span>
                </a>
                <a href="{{ route('pencari-kerja.lowongan-tersimpan.index') }}"
                    class="flex items-center space-x-3 px-4 py-3 text-sm font-medium rounded-xl {{ request()->routeIs('pencari-kerja.lowongan-tersimpan.*') ? 'bg-teal-50 text-primary' : 'text-gray-600 hover:bg-gray-50 hover:text-primary' }}">
                    <i class="fa-solid fa-bookmark text-lg"></i>
                    <span>Lowongan Tersimpan</span>
                </a>
                <a href="{{ route('pencari-kerja.profil.edit') }}"
                    class="flex items-center space-x-3 px-4 py-3 text-sm font-medium rounded-xl {{ request()->routeIs('pencari-kerja.profil.*') ? 'bg-teal-50 text-primary' : 'text-gray-600 hover:bg-gray-50 hover:text-primary' }}">
                    <i class="fa-solid fa-user text-lg"></i>
                    <span>Profil Saya</span>
                </a>
                <a href="{{ route('pencari-kerja.bantuan') }}"
                    class="flex items-center space-x-3 px-4 py-3 text-sm font-medium rounded-xl {{ request()->routeIs('pencari-kerja.bantuan') ? 'bg-teal-50 text-primary' : 'text-gray-600 hover:bg-gray-50 hover:text-primary' }}">
                    <i class="fa-solid fa-circle-question text-lg"></i>
                    <span>Bantuan</span>
                </a>
            </div>

            <div class="mt-12 pt-6 border-t border-gray-100">
                <form action="{{ route('logout') }}" method="POST">
                    @csrf
                    <button type="submit"
                        class="w-full flex items-center space-x-3 px-4 py-3 text-sm font-medium rounded-xl text-red-600 hover:bg-red-50">
                        <i class="fa-solid fa-arrow-right-from-bracket text-lg"></i>
                        <span>Keluar</span>
                    </button>
                </form>
            </div>
        </aside>

        <main class="flex-1 md:ml-64 p-6 min-h-[calc(100vh-4rem)]">
            @if (session('success'))
                <div class="mb-4 p-4 bg-green-50 text-green-700 border border-green-200 rounded-xl text-sm">
                    {{ session('success') }}
                </div>
            @endif
            @yield('content')
        </main>
    </div>

    @stack('scripts')
</body>

</html>
