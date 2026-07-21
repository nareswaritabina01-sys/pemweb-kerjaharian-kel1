<?php

namespace App\Http\Controllers\PemberiKerja;

use App\Http\Controllers\Controller;
use App\Models\Lamaran;
use App\Services\LamaranService;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;

class LamaranController extends Controller
{
    public function __construct(protected LamaranService $lamaranService) {}

    public function terima(Request $request, Lamaran $lamaran): RedirectResponse
    {
        $this->pastikanPemilikLowongan($request, $lamaran);
        $this->pastikanMasihMenunggu($lamaran);

        $this->lamaranService->terima($lamaran);

        return redirect()
            ->route('pemberi-kerja.lowongan.show', $lamaran->id_lowongan)
            ->with('success', "Lamaran {$lamaran->pencariKerja->nama} berhasil diterima.");
    }

    public function tolak(Request $request, Lamaran $lamaran): RedirectResponse
    {
        $this->pastikanPemilikLowongan($request, $lamaran);
        $this->pastikanMasihMenunggu($lamaran);

        $this->lamaranService->tolak($lamaran);

        return redirect()
            ->route('pemberi-kerja.lowongan.show', $lamaran->id_lowongan)
            ->with('success', "Lamaran {$lamaran->pencariKerja->nama} ditolak.");
    }

    private function pastikanPemilikLowongan(Request $request, Lamaran $lamaran): void
    {
        /** @var \App\Models\User $user */
        $user = $request->user();

        abort_if($lamaran->lowongan->id_pemberi_kerja !== $user->id, 403);
    }

    private function pastikanMasihMenunggu(Lamaran $lamaran): void
    {
        abort_if($lamaran->status !== 'menunggu', 400, 'Lamaran ini sudah diproses sebelumnya.');
    }
}
