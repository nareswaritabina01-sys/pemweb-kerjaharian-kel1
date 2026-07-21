@extends('layouts.app')

@section('content')
    <div class="mb-6">
        <h1 class="text-2xl font-bold text-gray-900">Pesan</h1>
        <p class="text-gray-600 text-sm">
            {{ auth()->user()->isPemberiKerja() ? 'Hubungi pekerja yang Anda terima untuk berdiskusi mengenai pekerjaan.' : 'Hubungi pemberi kerja secara langsung untuk berdiskusi mengenai pekerjaan.' }}
        </p>
    </div>

    @php
        $prefixRoute = auth()->user()->isPemberiKerja() ? 'pemberi-kerja' : 'pencari-kerja';
    @endphp

    <div
        class="bg-white border border-gray-200 rounded-2xl shadow-sm overflow-hidden flex h-[calc(100vh-12rem)] min-h-[500px]">
        {{-- Sidebar daftar percakapan --}}
        <div
            class="w-full md:w-80 border-r border-gray-200 flex flex-col bg-gray-50/50 shrink-0 {{ $percakapanAktif ? 'hidden md:flex' : 'flex' }}">
            <div class="p-4 border-b border-gray-200 bg-white">
                <span class="text-xs font-bold text-gray-500">{{ $daftarPercakapan->count() }} Percakapan</span>
            </div>

            <div class="flex-1 overflow-y-auto divide-y divide-gray-100 bg-white">
                @forelse ($daftarPercakapan as $item)
                    @php
                        $partner = $item->lawanBicara(auth()->user());
                        $aktif = $percakapanAktif && $percakapanAktif->id === $item->id;
                    @endphp
                    <a href="{{ route($prefixRoute . '.pesan.show', $item) }}"
                        class="p-4 flex items-start space-x-3 cursor-pointer transition {{ $aktif ? 'bg-teal-50/40 border-l-4 border-primary' : 'hover:bg-gray-50' }}">
                        <div
                            class="w-10 h-10 rounded-full bg-gray-200 flex items-center justify-center font-bold text-gray-600 shrink-0">
                            {{ strtoupper(substr($partner->nama ?? '?', 0, 1)) }}
                        </div>
                        <div class="flex-1 min-w-0">
                            <h4 class="text-xs font-bold text-gray-900 truncate">{{ $partner->nama ?? 'Pengguna' }}</h4>
                            <p class="text-[11px] text-gray-500 truncate mt-0.5">{{ $item->lamaran->lowongan->judul }}</p>
                        </div>
                    </a>
                @empty
                    <div class="p-6 text-center">
                        <p class="text-xs text-gray-500">Belum ada percakapan. Pesan akan muncul setelah lamaran diterima.</p>
                    </div>
                @endforelse
            </div>
        </div>

        {{-- Panel chat --}}
        <div class="flex-1 flex-col bg-white {{ $percakapanAktif ? 'flex' : 'hidden md:flex' }}">
            @if ($percakapanAktif)
                @php $partner = $percakapanAktif->lawanBicara(auth()->user()); @endphp

                <div class="px-6 py-4 border-b border-gray-200 flex items-center justify-between shadow-sm z-10 bg-white">
                    <div class="flex items-center space-x-3">
                        <a href="{{ route($prefixRoute . '.pesan.index') }}" class="md:hidden text-gray-400"><i
                                class="fa-solid fa-arrow-left"></i></a>
                        <div
                            class="w-10 h-10 rounded-full bg-gray-200 flex items-center justify-center font-bold text-gray-600">
                            {{ strtoupper(substr($partner->nama ?? '?', 0, 1)) }}
                        </div>
                        <div>
                            <h3 class="text-xs font-bold text-gray-900">{{ $partner->nama ?? 'Pengguna' }}</h3>
                            <span class="text-[10px] text-gray-400">{{ $percakapanAktif->lamaran->lowongan->judul }}</span>
                        </div>
                    </div>
                </div>

                <div id="list-pesan" class="flex-1 p-6 overflow-y-auto bg-gray-50/50 space-y-4 flex flex-col">
                    @forelse ($percakapanAktif->pesan as $pesan)
                        @php $milikSaya = $pesan->id_pengirim === auth()->id(); @endphp
                        <div data-id="{{ $pesan->id }}"
                            class="flex items-start space-x-2.5 max-w-lg {{ $milikSaya ? 'self-end justify-end' : '' }}">
                            @unless ($milikSaya)
                                <div
                                    class="w-8 h-8 rounded-full bg-gray-200 flex items-center justify-center text-xs font-bold text-gray-600 shrink-0">
                                    {{ strtoupper(substr($pesan->pengirim->nama, 0, 1)) }}
                                </div>
                            @endunless
                            <div
                                class="{{ $milikSaya ? 'bg-primary text-white rounded-tr-none' : 'bg-white border border-gray-100 text-gray-800 rounded-tl-none' }} rounded-2xl p-3 shadow-sm">
                                <p class="text-xs leading-relaxed">{{ $pesan->isi }}</p>
                                <span
                                    class="text-[9px] {{ $milikSaya ? 'text-teal-100' : 'text-gray-400' }} block text-right mt-1">
                                    {{ $pesan->created_at->format('H:i') }}
                                </span>
                            </div>
                        </div>
                    @empty
                        <div class="flex-1 flex items-center justify-center">
                            <p class="text-xs text-gray-400">Belum ada pesan. Mulai percakapan sekarang.</p>
                        </div>
                    @endforelse
                </div>

                <form id="form-kirim-pesan" class="p-4 border-t border-gray-200 bg-white flex items-center space-x-3">
                    <div class="flex-1">
                        <input type="text" id="input-isi-pesan" placeholder="Tulis pesan..." autocomplete="off"
                            class="w-full px-4 py-2 bg-gray-50 border border-gray-200 rounded-xl text-xs text-gray-800 focus:outline-none focus:ring-2 focus:ring-primary">
                    </div>
                    <button type="submit"
                        class="bg-primary hover:bg-primary-hover text-white w-9 h-9 rounded-xl flex items-center justify-center shrink-0 transition">
                        <i class="fa-solid fa-paper-plane text-sm"></i>
                    </button>
                </form>
            @else
                <div class="flex-1 flex items-center justify-center">
                    <div class="text-center">
                        <i class="fa-solid fa-comments text-3xl text-gray-300"></i>
                        <p class="text-xs text-gray-400 mt-3">Pilih percakapan untuk mulai membaca pesan.</p>
                    </div>
                </div>
            @endif
        </div>
    </div>
@endsection

@push('scripts')
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const percakapanAktif = @json($percakapanAktif?->id);
            if (!percakapanAktif) return;

            const prefixRoute = @json($prefixRoute);
            const form = document.getElementById('form-kirim-pesan');
            const inputIsi = document.getElementById('input-isi-pesan');
            const listPesan = document.getElementById('list-pesan');
            let idPesanTerakhir = listPesan?.lastElementChild?.dataset.id ? parseInt(listPesan.lastElementChild
                .dataset.id) : 0;

            function tambahBubble(pesan, isMilikSaya) {
                const bubble = document.createElement('div');
                bubble.dataset.id = pesan.id;
                bubble.className = isMilikSaya ? 'flex justify-end mb-3' : 'flex justify-start mb-3';
                bubble.innerHTML = `
            <div class="max-w-xs px-4 py-2 rounded-2xl ${isMilikSaya ? 'bg-primary text-white' : 'bg-white border'}">
                <p class="text-sm">${pesan.isi}</p>
                <span class="text-xs opacity-70">${pesan.dibuat_pada}</span>
            </div>`;
                listPesan.appendChild(bubble);
                listPesan.scrollTop = listPesan.scrollHeight;
            }

            form?.addEventListener('submit', function(e) {
                e.preventDefault();
                const isi = inputIsi.value.trim();
                if (!isi) return;

                fetch(`/${prefixRoute}/pesan/${percakapanAktif}/kirim`, {
                        method: 'POST',
                        headers: {
                            'Content-Type': 'application/json',
                            'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content,
                        },
                        body: JSON.stringify({ isi }),
                    })
                    .then(res => res.json())
                    .then(data => {
                        if (data.sukses) {
                            tambahBubble(data.pesan, true);
                            idPesanTerakhir = data.pesan.id;
                            inputIsi.value = '';
                        }
                    });
            });

            setInterval(function() {
                fetch(`/${prefixRoute}/pesan/${percakapanAktif}/baru?sejak_id=${idPesanTerakhir}`)
                    .then(res => res.json())
                    .then(data => {
                        data.pesan.forEach(p => {
                            if (p.id_pengirim != {{ auth()->id() }}) {
                                tambahBubble(p, false);
                            }
                            idPesanTerakhir = Math.max(idPesanTerakhir, p.id);
                        });
                    });
            }, 4000);
        });
    </script>
@endpush