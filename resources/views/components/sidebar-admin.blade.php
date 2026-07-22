<div class="space-y-1">
    <a href="{{ route('admin.dashboard') }}"
        class="flex items-center space-x-3 px-4 py-3 text-sm font-medium rounded-xl {{ request()->routeIs('admin.dashboard') ? 'bg-teal-50 text-primary' : 'text-gray-600 hover:bg-gray-50 hover:text-primary' }}">
        <i class="fa-solid fa-house text-lg"></i>
        <span>Dashboard</span>
    </a>
    <a href="{{ Route::has('admin.pengguna.index') ? route('admin.pengguna.index') : '#' }}"
        class="flex items-center space-x-3 px-4 py-3 text-sm font-medium rounded-xl {{ request()->routeIs('admin.pengguna.*') ? 'bg-teal-50 text-primary' : 'text-gray-600 hover:bg-gray-50 hover:text-primary' }}">
        <i class="fa-solid fa-users text-lg"></i>
        <span>Kelola User</span>
    </a>
    <a href="{{ Route::has('admin.lowongan.index') ? route('admin.lowongan.index') : '#' }}"
        class="flex items-center space-x-3 px-4 py-3 text-sm font-medium rounded-xl {{ request()->routeIs('admin.lowongan.*') ? 'bg-teal-50 text-primary' : 'text-gray-600 hover:bg-gray-50 hover:text-primary' }}">
        <i class="fa-solid fa-briefcase text-lg"></i>
        <span>Kelola Lowongan</span>
    </a>
    <a href="{{ route('admin.kategori.index') }}"
        class="flex items-center space-x-3 px-4 py-3 text-sm font-medium rounded-xl {{ request()->routeIs('admin.kategori.*') ? 'bg-teal-50 text-primary' : 'text-gray-600 hover:bg-gray-50 hover:text-primary' }}">
        <i class="fa-solid fa-tags text-lg"></i>
        <span>Kategori</span>
    </a>
    <a href="{{ Route::has('admin.laporan.index') ? route('admin.laporan.index') : '#' }}"
        class="flex items-center space-x-3 px-4 py-3 text-sm font-medium rounded-xl {{ request()->routeIs('admin.laporan.*') ? 'bg-teal-50 text-primary' : 'text-gray-600 hover:bg-gray-50 hover:text-primary' }}">
        <i class="fa-solid fa-flag text-lg"></i>
        <span>Laporan</span>
    </a>
</div>
