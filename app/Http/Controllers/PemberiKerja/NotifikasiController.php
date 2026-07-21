<?php

namespace App\Http\Controllers\PemberiKerja;

use App\Http\Controllers\Controller;
use App\Models\Notifikasi;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\View\View;

class NotifikasiController extends Controller
{
    public function index(Request $request): View
    {
        /** @var User $user */
        $user = $request->user();

        $items = Notifikasi::where('user_id', $user->id)
            ->latest()
            ->limit(50)
            ->get()
            ->map(function ($n) {
                return (object) [
                    'id' => $n->id,
                    'tipe' => $n->tipe,
                    'judul' => $n->judul,
                    'pesan' => $n->pesan,
                    'status' => null,
                    'waktu' => $n->created_at,
                    'link' => $n->link,
                    'read_at' => $n->read_at,
                ];
            });

        return view('pemberi-kerja.notifikasi', ['notifikasi' => $items]);
    }

    public function baca(Request $request, Notifikasi $notifikasi)
    {
        /** @var User $user */
        $user = $request->user();

        if ($notifikasi->user_id !== $user->id) {
            abort(403);
        }

        $notifikasi->update(['read_at' => now()]);

        return redirect()->to($notifikasi->link ?? route('pemberi-kerja.notifikasi'));
    }
}
