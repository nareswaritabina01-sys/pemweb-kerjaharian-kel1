@extends('layouts.app')

@section('content')
<div class="container mx-auto p-6 bg-gray-50">
    <h2 class="text-xl font-bold mb-6">Detail Lamaran</h2>
    
    <div class="bg-white p-6 rounded-lg shadow-sm border border-gray-100">
        <div class="flex justify-between items-start mb-6">
            <div>
                <h1 class="text-xl font-bold">{{ $application->vacancy->title }}</h1>
                <p class="text-gray-500 text-sm">{{ $application->vacancy->company_name }}</p>
                <p class="text-sm text-gray-400 mt-2">ID: {{ $application->id_code }} | {{ $application->created_at->format('d M Y') }}</p>
            </div>
            <span class="px-3 py-1 bg-blue-100 text-blue-700 text-xs font-bold rounded-full">
                {{ $application->status }}
            </span>
        </div>

        <div class="grid grid-cols-2 gap-4 border-t pt-4 text-sm">
            <div>
                <p class="text-gray-400">Catatan dari Pemberi Kerja</p>
                <p class="text-gray-800 mt-1">{{ $application->employer_notes ?? 'Belum ada catatan' }}</p>
            </div>
            <div>
                <p class="text-gray-400">Dokumen Lamaran</p>
                <div class="mt-1 space-y-1">
                    <p class="text-blue-600 underline cursor-pointer">CV_Andi_Pratama.pdf</p>
                    <p class="text-blue-600 underline cursor-pointer">KTP_Andi.jpg</p>
                </div>
            </div>
        </div>

        <div class="mt-8 border-t pt-6">
            <h3 class="font-bold mb-4">Timeline Lamaran</h3>
            <div class="relative border-l ml-2">
                <div class="mb-6 ml-6">
                    <div class="absolute -left-1.5 w-3 h-3 bg-green-500 rounded-full"></div>
                    <p class="text-sm font-bold">Lamaran dikirim</p>
                    <p class="text-xs text-gray-400">{{ $application->created_at }}</p>
                </div>
                </div>
        </div>
    </div>
</div>
@endsection