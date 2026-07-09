@extends('layouts.app')

@section('content')
<div class="max-w-6xl mx-auto">
    <!-- Search Bar -->
    <form action="{{ route('jobs.index') }}" method="GET" class="flex items-center bg-white rounded-full border border-gray-200 shadow-sm p-2 mb-8 w-full max-w-4xl mx-auto">
        <i class="fa-solid fa-magnifying-glass text-gray-400 px-6"></i>
        <input type="text" name="search" value="{{ request('search') }}" placeholder="Cari pekerjaan, lokasi, atau keahlian..." class="w-full focus:outline-none text-sm text-gray-700">
        <button type="submit" class="bg-[#007A87] hover:bg-teal-800 text-white font-bold px-8 py-3 rounded-full text-sm transition">Cari</button>
    </form>

    <!-- Category Pills -->
    <div class="flex flex-wrap gap-3 mb-10 justify-center">
        @php
            $categories = ['Pertukangan', 'ART', 'Buruh Harian', 'Supir', 'Security', 'Tukang Kebun', 'Laundry', 'Lainnya'];
        @endphp
        @foreach($categories as $cat)
            <button class="px-6 py-2.5 rounded-full border border-gray-200 bg-white text-xs font-semibold text-gray-600 hover:border-[#007A87] hover:text-[#007A87] transition flex items-center gap-2">
                {{ $cat }}
            </button>
        @endforeach
    </div>

    <!-- Job Grid -->
    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6">
        @foreach($vacancies as $job)
        <div class="bg-white rounded-2xl border border-gray-100 shadow-sm overflow-hidden hover:shadow-lg transition">
            <div class="h-32 bg-teal-50 flex items-center justify-center">
                <i class="fa-solid fa-location-dot text-[#007A87] text-2xl"></i>
            </div>
            
            <div class="p-5">
                <div class="text-[10px] font-bold text-green-700 bg-green-50 px-2 py-1 rounded w-fit mb-3 flex items-center gap-1">
                    <i class="fa-solid fa-shield-halved"></i> Dana Aman di Rekber
                </div>
                
                <h3 class="font-bold text-gray-900 text-sm mb-1">{{ $job->title }}</h3>
                <p class="text-[11px] text-gray-500 mb-1"><i class="fa-solid fa-building mr-1"></i>{{ $job->company_name }}</p>
                <p class="text-[11px] text-gray-500 mb-3"><i class="fa-solid fa-location-dot mr-1"></i>{{ $job->location }}</p>
                
                <p class="font-bold text-[#007A87] text-xs mb-4">Rp {{ number_format($job->salary, 0, ',', '.') }} / hari</p>
                
                <div class="flex justify-between items-center text-[10px] text-gray-400 border-t pt-3 mb-4">
                    <span><i class="fa-solid fa-calendar-day mr-1"></i>Harian</span>
                    <span><i class="fa-solid fa-clock mr-1"></i>{{ $job->created_at->diffForHumans() }}</span>
                </div>

                <button class="w-full bg-[#f4b41a] hover:bg-yellow-500 text-black font-bold py-3 rounded-xl text-xs transition">
                    Detail & Lamar
                </button>
            </div>
        </div>
        @endforeach
    </div>
</div>
@endsection