<?php

namespace App\Http\Controllers\PencariKerja;

use App\Http\Controllers\Controller;
use App\Models\Kontrak;
use App\Services\KontrakService;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;

class KontrakController extends Controller
{
    public function __construct(protected KontrakService $kontrakService) {}

    public function konfirmasiDibayar(Request $request, Kontrak $kontrak): RedirectResponse
    {
        /** @var \App\Models\User $user */
        $user = $request->user();
        abort_unless($kontrak->lamaran->id_pencari_kerja === $user->id, 403);

        try {
            $this->kontrakService->konfirmasiDibayar($kontrak);
        } catch (\Illuminate\Validation\ValidationException $e) {
            return back()->with('error', $e->getMessage());
        }

        return back()->with('success', 'Pembayaran berhasil dikonfirmasi. Kontrak sekarang berstatus dibayar.');
    }

    public function ajukanSengketa(Request $request, Kontrak $kontrak): RedirectResponse
    {
        /** @var \App\Models\User $user */
        $user = $request->user();
        abort_unless($kontrak->lamaran->id_pencari_kerja === $user->id, 403);

        try {
            $this->kontrakService->ajukanSengketa($kontrak);
        } catch (\Illuminate\Validation\ValidationException $e) {
            return back()->with('error', $e->getMessage());
        }

        return back()->with('success', 'Sengketa kontrak berhasil diajukan. Admin akan meninjau kasus ini.');
    }
}
