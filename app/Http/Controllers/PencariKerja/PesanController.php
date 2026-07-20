<?php

namespace App\Http\Controllers\PencariKerja;

use App\Http\Controllers\Controller;
use App\Http\Requests\PencariKerja\PesanRequest;
use App\Models\Percakapan;
use App\Services\PesanService;
use Illuminate\Http\Request;

class PesanController extends Controller
{
    public function __construct(protected PesanService $pesanService) {}

    public function index(Request $request)
    {
        /** @var \App\Models\User $user */
        $user = $request->user();

        $daftarPercakapan = Percakapan::whereHas('lamaran', function ($query) use ($user) {
            $query->where('id_pencari_kerja', $user->id)
                ->orWhereHas('lowongan', fn($q) => $q->where('id_pemberi_kerja', $user->id));
        })
            ->with(['lamaran.lowongan.pemberiKerja', 'lamaran.pencariKerja', 'pesan' => fn($q) => $q->latest()->limit(1)])
            ->latest('updated_at')
            ->get();

        return view('pencari-kerja.pesan', [
            'daftarPercakapan' => $daftarPercakapan,
            'percakapanAktif' => null,
            'pesanList' => collect(),
        ]);
    }

    public function show(Request $request, Percakapan $percakapan)
    {
        /** @var \App\Models\User $user */
        $user = $request->user();

        $idPencariKerja = $percakapan->lamaran->id_pencari_kerja;
        $idPemberiKerja = $percakapan->lamaran->lowongan->id_pemberi_kerja;

        abort_unless($user->id === $idPencariKerja || $user->id === $idPemberiKerja, 403);

        $this->pesanService->tandaiDibaca($percakapan, $user);

        $daftarPercakapan = Percakapan::whereHas('lamaran', function ($query) use ($user) {
            $query->where('id_pencari_kerja', $user->id)
                ->orWhereHas('lowongan', fn($q) => $q->where('id_pemberi_kerja', $user->id));
        })
            ->with(['lamaran.lowongan.pemberiKerja', 'lamaran.pencariKerja', 'pesan' => fn($q) => $q->latest()->limit(1)])
            ->latest('updated_at')
            ->get();

        $percakapan->load(['lamaran.lowongan.pemberiKerja', 'pesan.pengirim']);

        return view('pencari-kerja.pesan', [
            'daftarPercakapan' => $daftarPercakapan,
            'percakapanAktif' => $percakapan,
            'pesanList' => $percakapan->pesan,
        ]);
    }

    public function kirim(PesanRequest $request, Percakapan $percakapan)
    {
        /** @var \App\Models\User $user */
        $user = $request->user();

        $pesan = $this->pesanService->kirim($percakapan, $user, $request->validated('isi'));

        return response()->json([
            'sukses' => true,
            'pesan' => [
                'id' => $pesan->id,
                'isi' => $pesan->isi,
                'id_pengirim' => $pesan->id_pengirim,
                'nama_pengirim' => $pesan->pengirim->nama,
                'dibuat_pada' => $pesan->created_at->format('H:i'),
            ],
        ]);
    }

    public function ambilBaru(Request $request, Percakapan $percakapan)
    {
        /** @var \App\Models\User $user */
        $user = $request->user();

        $idPencariKerja = $percakapan->lamaran->id_pencari_kerja;
        $idPemberiKerja = $percakapan->lamaran->lowongan->id_pemberi_kerja;

        abort_unless($user->id === $idPencariKerja || $user->id === $idPemberiKerja, 403);

        $sejakId = (int) $request->query('sejak_id', 0);
        $pesanBaru = $this->pesanService->ambilBaru($percakapan, $sejakId);

        return response()->json([
            'pesan' => $pesanBaru->map(fn($p) => [
                'id' => $p->id,
                'isi' => $p->isi,
                'id_pengirim' => $p->id_pengirim,
                'nama_pengirim' => $p->pengirim->nama,
                'dibuat_pada' => $p->created_at->format('H:i'),
            ]),
        ]);
    }
}
