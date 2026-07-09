<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Kerja Harian</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
</head>
<body class="bg-[#f8fafc] text-gray-800 font-sans">
    <!-- Navbar Atas -->
    <nav class="bg-white border-b border-gray-200 fixed top-0 z-50 w-full px-6 py-3 flex justify-between items-center shadow-sm">
        <div class="flex items-center space-x-2">
            <div class="bg-[#f4b41a] text-white p-2 rounded-lg font-bold text-lg w-10 h-10 flex items-center justify-center shadow-sm">K</div>
            <span class="text-xl font-bold text-[#007A87]">KerjaHarian</span>
        </div>
        <div class="flex items-center space-x-6 text-sm font-medium">
            <a href="{{ route('jobs.index') }}" class="{{ request()->routeIs('jobs.index') ? 'text-[#007A87] border-b-2 border-[#007A87] pb-1' : 'text-gray-600 hover:text-[#007A87]' }}">Cari Kerja</a>
            <a href="{{ route('dashboard') }}" class="{{ request()->routeIs('dashboard') ? 'text-[#007A87] border-b-2 border-[#007A87] pb-1' : 'text-gray-600 hover:text-[#007A87]' }}">Dashboard</a>
            <a href="{{ route('applications.index') }}" class="{{ request()->routeIs('applications.*') ? 'text-[#007A87] border-b-2 border-[#007A87] pb-1' : 'text-gray-600 hover:text-[#007A87]' }}">Lamaran Saya</a>
            <a href="{{ route('messages') }}" class="{{ request()->routeIs('messages') ? 'text-[#007A87] border-b-2 border-[#007A87] pb-1' : 'text-gray-600 hover:text-[#007A87]' }}">Pesan</a>
            <a href="{{ route('notifications') }}" class="{{ request()->routeIs('notifications') ? 'text-[#007A87] border-b-2 border-[#007A87] pb-1' : 'text-gray-600 hover:text-[#007A87]' }} flex items-center space-x-1">
                <span>Notifikasi</span>
                <span class="w-2 h-2 rounded-full bg-red-500 block"></span>
            </a>
            <div class="flex items-center space-x-2 border-l pl-4 border-gray-200">
                <div class="w-8 h-8 rounded-full bg-gray-300 flex items-center justify-center text-xs font-bold text-gray-600">A</div>
                <span class="text-gray-700 hidden md:inline">Halo, Andi</span>
            </div>
        </div>
    </nav>

    <!-- Sidebar & Konten -->
    <div class="flex pt-16">
        <aside class="w-64 bg-white h-[calc(100vh-4rem)] border-r border-gray-200 fixed left-0 top-16 overflow-y-auto hidden md:block px-4 py-6">
            <div class="space-y-1">
                <a href="{{ route('dashboard') }}" class="flex items-center space-x-3 px-4 py-3 text-sm font-medium rounded-xl {{ request()->routeIs('dashboard') ? 'bg-teal-50 text-[#007A87]' : 'text-gray-600 hover:bg-gray-50 hover:text-[#007A87]' }}">
                    <i class="fa-solid fa-house text-lg"></i>
                    <span>Dashboard</span>
                </a>
                <a href="{{ route('profile') }}" class="flex items-center space-x-3 px-4 py-3 text-sm font-medium rounded-xl {{ request()->routeIs('profile') ? 'bg-teal-50 text-[#007A87]' : 'text-gray-600 hover:bg-gray-50 hover:text-[#007A87]' }}">
                    <i class="fa-solid fa-user text-lg"></i>
                    <span>Profil Saya</span>
                </a>
                <a href="{{ route('jobs.index') }}" class="flex items-center space-x-3 px-4 py-3 text-sm font-medium rounded-xl {{ request()->routeIs('jobs.index') ? 'bg-teal-50 text-[#007A87]' : 'text-gray-600 hover:bg-gray-50 hover:text-[#007A87]' }}">
                    <i class="fa-solid fa-magnifying-glass text-lg"></i>
                    <span>Cari Kerja</span>
                </a>
                <a href="{{ route('applications.index') }}" class="flex items-center space-x-3 px-4 py-3 text-sm font-medium rounded-xl {{ request()->routeIs('applications.*') ? 'bg-teal-50 text-[#007A87]' : 'text-gray-600 hover:bg-gray-50 hover:text-[#007A87]' }}">
                    <i class="fa-solid fa-file-invoice text-lg"></i>
                    <span>Lamaran Saya</span>
                </a>
                <a href="{{ route('messages') }}" class="flex items-center space-x-3 px-4 py-3 text-sm font-medium rounded-xl {{ request()->routeIs('messages') ? 'bg-teal-50 text-[#007A87]' : 'text-gray-600 hover:bg-gray-50 hover:text-[#007A87]' }}">
                    <i class="fa-solid fa-comment-dots text-lg"></i>
                    <span>Pesan</span>
                </a>
                <a href="{{ route('saved-jobs') }}" class="flex items-center space-x-3 px-4 py-3 text-sm font-medium rounded-xl {{ request()->routeIs('saved-jobs') ? 'bg-teal-50 text-[#007A87]' : 'text-gray-600 hover:bg-gray-50 hover:text-[#007A87]' }}">
                    <i class="fa-solid fa-bookmark text-lg"></i>
                    <span>Pekerjaan Tersimpan</span>
                </a>
                <a href="#" class="flex items-center space-x-3 px-4 py-3 text-sm font-medium rounded-xl text-gray-600 hover:bg-gray-50 hover:text-[#007A87]">
                    <i class="fa-solid fa-history text-lg"></i>
                    <span>Riwayat Pekerjaan</span>
                </a>
                <a href="{{ route('notifications') }}" class="flex items-center justify-between px-4 py-3 text-sm font-medium rounded-xl {{ request()->routeIs('notifications') ? 'bg-teal-50 text-[#007A87]' : 'text-gray-600 hover:bg-gray-50 hover:text-[#007A87]' }}">
                    <div class="flex items-center space-x-3">
                        <i class="fa-solid fa-bell text-lg"></i>
                        <span>Notifikasi</span>
                    </div>
                    <span class="w-2 h-2 rounded-full bg-red-500"></span>
                </a>
                <a href="#" class="flex items-center space-x-3 px-4 py-3 text-sm font-medium rounded-xl text-gray-600 hover:bg-gray-50 hover:text-[#007A87]">
                    <i class="fa-solid fa-gear text-lg"></i>
                    <span>Pengaturan</span>
                </a>
                <a href="{{ route('help') }}" class="flex items-center space-x-3 px-4 py-3 text-sm font-medium rounded-xl {{ request()->routeIs('help') ? 'bg-teal-50 text-[#007A87]' : 'text-gray-600 hover:bg-gray-50 hover:text-[#007A87]' }}">
                    <i class="fa-solid fa-circle-question text-lg"></i>
                    <span>Bantuan</span>
                </a>
            </div>
            <div class="mt-12 pt-6 border-t border-gray-100">
                <a href="{{ route('logout') }}" class="flex items-center space-x-3 px-4 py-3 text-sm font-medium rounded-xl text-red-600 hover:bg-red-50">
                    <i class="fa-solid fa-arrow-right-from-bracket text-lg"></i>
                    <span>Keluar</span>
                </a>
            </div>
        </aside>

        <!-- Main Content Area -->
        <main class="flex-1 md:ml-64 p-6 min-h-[calc(100vh-4rem)]">
            @yield('content')
        </main>
    </div>
</body>
</html>