<?php

namespace App\Http\Controllers\PencariKerja;

use App\Http\Controllers\Controller;
use App\Models\Lamaran;
use App\Models\Pesan;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\View\View;

class NotifikasiController extends Controller
{
    public function index(Request $request): View
    {
        /** @var User $user */
        $user = $request->user();

        $lamaranDiproses = Lamaran::with('lowongan')
            ->where('id_pencari_kerja', $user->id)
            ->whereIn('status', ['diterima', 'ditolak'])
            ->latest('updated_at')
            ->limit(15)
            ->get()
            ->map(function ($item) {
                return (object) [
                    'tipe' => 'lamaran',
                    'judul' => $item->status === 'diterima'
                        ? 'Lamaran Anda diterima'
                        : 'Lamaran Anda ditolak',
                    'pesan' => $item->lowongan->judul,
                    'status' => $item->status,
                    'waktu' => $item->updated_at,
                    'link' => route('pencari-kerja.lamaran.show', $item->id),
                ];
            });

        $pesanBaru = Pesan::with('percakapan.lamaran.lowongan', 'pengirim')
            ->whereHas('percakapan.lamaran', fn ($q) => $q->where('id_pencari_kerja', $user->id))
            ->where('id_pengirim', '!=', $user->id)
            ->whereNull('dibaca_pada')
            ->latest('created_at')
            ->limit(15)
            ->get()
            ->map(function ($item) {
                return (object) [
                    'tipe' => 'pesan',
                    'judul' => 'Pesan baru dari ' . $item->pengirim->nama,
                    'pesan' => $item->isi,
                    'status' => null,
                    'waktu' => $item->created_at,
                    'link' => route('pencari-kerja.pesan.show', $item->id_percakapan),
                ];
            });

        $notifikasi = $lamaranDiproses->concat($pesanBaru)->sortByDesc('waktu')->values();

        return view('pencari-kerja.notifikasi', compact('notifikasi'));
    }
}