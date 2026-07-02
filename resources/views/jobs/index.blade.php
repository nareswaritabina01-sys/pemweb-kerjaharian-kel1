@extends('layouts.app')

@section('content')
<div class="mb-6">
    <h1 class="text-2xl font-bold text-gray-900">Cari Kerja Harian</h1>
    <p class="text-gray-600 text-sm">Temukan berbagai proyek pertukangan, pengecatan, dan jasa harian di sekitarmu.</p>
</div>

<div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
    @forelse($vacancies as $job)
        <div class="bg-white border border-gray-200 rounded-2xl p-5 shadow-sm flex flex-col justify-between hover:border-teal-500 transition">
            <div>
                <div class="flex justify-between items-start">
                    <div class="w-10 h-10 bg-teal-50 text-[#007A87] rounded-xl flex items-center justify-center text-sm font-bold">
                        <i class="fa-solid fa-briefcase"></i>
                    </div>
                    <span class="px-2.5 py-0.5 bg-green-50 text-green-700 text-[10px] font-bold rounded-full border border-green-100">Aktif</span>
                </div>
                <div class="mt-4">
                    <h3 class="text-xs font-bold text-gray-900">{{ $job->title }}</h3>
                    <p class="text-[11px] text-gray-500 mt-0.5">{{ $job->company_name ?? 'Penyedia Kerja Harian' }} • {{ $job->location }}</p>
                </div>
                <p class="text-xs text-gray-600 mt-3 line-clamp-2 leading-relaxed">
                    {{ $job->description }}
                </p>
                <div class="mt-4 flex items-center space-x-4 text-[11px] text-gray-400">
                    <span><i class="fa-solid fa-money-bill-wave text-teal-600 mr-1"></i> Rp {{ number_format($job->salary, 0, ',', '.') }}/hari</span>
                </div>
            </div>
            <div class="mt-6 pt-4 border-t border-gray-100 flex items-center justify-between">
                <span class="text-[10px] text-gray-400 font-medium">Batas: {{ $job->deadline ?? 'Segera' }}</span>
                <a href="{{ route('jobs.show', $job->id) }}" class="bg-[#007A87] hover:bg-teal-700 text-white font-bold px-4 py-2 rounded-xl text-xs transition shadow-sm">
                    Lihat Detail
                </a>
            </div>
        </div>
    @empty
        <div class="col-span-full bg-white border border-gray-200 rounded-2xl p-8 text-center text-gray-500 text-xs">
            Belum ada lowongan kerja harian yang tersedia saat ini.
        </div>
    @endforelse
</div>
@endsection