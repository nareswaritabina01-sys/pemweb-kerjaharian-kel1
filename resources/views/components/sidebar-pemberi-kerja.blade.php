<div class="space-y-1">
    <a href="{{ route('pemberi-kerja.dashboard') }}"
        class="flex items-center space-x-3 px-4 py-3 text-sm font-medium rounded-xl {{ request()->routeIs('pemberi-kerja.dashboard') ? 'bg-teal-50 text-primary' : 'text-gray-600 hover:bg-gray-50 hover:text-primary' }}">
        <i class="fa-solid fa-house text-lg"></i>
        <span>Dashboard</span>
    </a>
    <a href="{{ route('pemberi-kerja.lowongan.index') }}"
        class="flex items-center space-x-3 px-4 py-3 text-sm font-medium rounded-xl {{ request()->routeIs('pemberi-kerja.lowongan.*') ? 'bg-teal-50 text-primary' : 'text-gray-600 hover:bg-gray-50 hover:text-primary' }}">
        <i class="fa-solid fa-briefcase text-lg"></i>
        <span>Lowongan Saya</span>
    </a>
    <a href="{{ route('pemberi-kerja.kontrak.index') }}"
        class="flex items-center space-x-3 px-4 py-3 text-sm font-medium rounded-xl {{ request()->routeIs('pemberi-kerja.kontrak.*') ? 'bg-teal-50 text-primary' : 'text-gray-600 hover:bg-gray-50 hover:text-primary' }}">
        <i class="fa-solid fa-file-signature text-lg"></i>
        <span>Kontrak</span>
    </a>
    <a href="{{ route('pemberi-kerja.pesan.index') }}"
        class="flex items-center space-x-3 px-4 py-3 text-sm font-medium rounded-xl {{ request()->routeIs('pemberi-kerja.pesan.*') ? 'bg-teal-50 text-primary' : 'text-gray-600 hover:bg-gray-50 hover:text-primary' }}">
        <i class="fa-solid fa-comment-dots text-lg"></i>
        <span>Pesan</span>
    </a>
    <a href="{{ route('pemberi-kerja.notifikasi') }}"
        class="flex items-center justify-between space-x-3 px-4 py-3 text-sm font-medium rounded-xl {{ request()->routeIs('pemberi-kerja.notifikasi') ? 'bg-teal-50 text-primary' : 'text-gray-600 hover:bg-gray-50 hover:text-primary' }}">
        <div class="flex items-center space-x-3">
            <i class="fa-solid fa-bell text-lg"></i>
            <span>Notifikasi</span>
        </div>
        @if (!empty($notifCount) && $notifCount > 0)
            <span
                class="ml-3 inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-red-100 text-red-700">{{ $notifCount }}</span>
        @endif
    </a>
    <a href="{{ route('pemberi-kerja.profil.edit') }}"
        class="flex items-center space-x-3 px-4 py-3 text-sm font-medium rounded-xl {{ request()->routeIs('pemberi-kerja.profil.*') ? 'bg-teal-50 text-primary' : 'text-gray-600 hover:bg-gray-50 hover:text-primary' }}">
        <i class="fa-solid fa-user text-lg"></i>
        <span>Profil</span>
    </a>
</div>
