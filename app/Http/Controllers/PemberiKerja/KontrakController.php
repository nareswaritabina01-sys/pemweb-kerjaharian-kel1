<?php

namespace App\Http\Controllers\PemberiKerja;

use App\Http\Controllers\Controller;
use App\Models\Kontrak;
use App\Services\KontrakService;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;

class KontrakController extends Controller
{
    public function __construct(protected KontrakService $kontrakService) {}

    public function index(Request $request): View
    {
        /** @var \App\Models\User $user */
        $user = $request->user();

        $status = $request->query('status');
        $kontrak = $this->kontrakService->milikPemberiKerja($user, $status);

        return view('pemberi-kerja.kontrak.index', compact('kontrak', 'status'));
    }

    public function show(Request $request, Kontrak $kontrak): View
    {
        /** @var \App\Models\User $user */
        $user = $request->user();

        $kontrak = $this->kontrakService->detail($kontrak->id, $user);

        return view('pemberi-kerja.kontrak.show', compact('kontrak'));
    }

    public function tandaiSelesai(Request $request, Kontrak $kontrak): RedirectResponse
    {
        $this->pastikanPemilik($request, $kontrak);

        try {
            $this->kontrakService->tandaiSelesai($kontrak);
        } catch (\Illuminate\Validation\ValidationException $e) {
            return back()->with('error', $e->getMessage());
        }

        return back()->with('success', 'Kontrak ditandai selesai. Silakan unggah bukti transfer.');
    }

    public function unggahBukti(Request $request, Kontrak $kontrak): RedirectResponse
    {
        $this->pastikanPemilik($request, $kontrak);

        $request->validate([
            'bukti_transfer' => ['required', 'file', 'mimes:jpg,jpeg,png,pdf', 'max:2048'],
        ]);

        try {
            $this->kontrakService->unggahBuktiTransfer($kontrak, $request->file('bukti_transfer'));
        } catch (\Illuminate\Validation\ValidationException $e) {
            return back()->with('error', $e->getMessage());
        }

        return back()->with('success', 'Bukti transfer berhasil diunggah.');
    }

    private function pastikanPemilik(Request $request, Kontrak $kontrak): void
    {
        /** @var \App\Models\User $user */
        $user = $request->user();

        abort_if($kontrak->lamaran->lowongan->id_pemberi_kerja !== $user->id, 403);
    }
}
