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
    <a href="{{ route('pencari-kerja.notifikasi') }}"
        class="flex items-center space-x-3 px-4 py-3 text-sm font-medium rounded-xl {{ request()->routeIs('pencari-kerja.notifikasi') ? 'bg-teal-50 text-primary' : 'text-gray-600 hover:bg-gray-50 hover:text-primary' }}">
        <i class="fa-solid fa-bell text-lg"></i>
        <span>Notifikasi</span>
        @if (isset($notifCount) && $notifCount > 0)
            <span
                class="ml-auto bg-[#007A87] text-white text-[9px] w-5 h-5 flex items-center justify-center rounded-full">{{ $notifCount }}</span>
        @endif
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
