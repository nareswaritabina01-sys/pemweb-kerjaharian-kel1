<?php

namespace App\Http\Controllers\PemberiKerja;

use App\Http\Controllers\Controller;
use App\Http\Requests\PemberiKerja\LowonganRequest;
use App\Models\Lowongan;
use App\Services\LowonganService;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;

class LowonganController extends Controller
{
    public function __construct(protected LowonganService $lowonganService) {}

    public function index(Request $request): View
    {
        /** @var \App\Models\User $user */
        $user = $request->user();

        $status = $request->query('status'); // filter opsional: dibuka/ditutup
        $lowongan = $this->lowonganService->milikSendiri($user, $status);

        return view('pemberi-kerja.lowongan.index', compact('lowongan', 'status'));
    }

    public function create(): View
    {
        return view('pemberi-kerja.lowongan.create');
    }

    public function store(LowonganRequest $request): RedirectResponse
    {
        /** @var \App\Models\User $user */
        $user = $request->user();

        $this->lowonganService->buat($user, $request->validated());

        return redirect()
            ->route('pemberi-kerja.lowongan.index')
            ->with('success', 'Lowongan berhasil dibuat.');
    }

    public function show(Request $request, Lowongan $lowongan): View
    {
        $this->pastikanPemilik($request, $lowongan);

        $lowongan->load(['lamaran.pencariKerja']);

        return view('pemberi-kerja.lowongan.show', compact('lowongan'));
    }

    public function edit(Request $request, Lowongan $lowongan): View
    {
        $this->pastikanPemilik($request, $lowongan);

        return view('pemberi-kerja.lowongan.edit', compact('lowongan'));
    }

    public function update(LowonganRequest $request, Lowongan $lowongan): RedirectResponse
    {
        $this->pastikanPemilik($request, $lowongan);

        $this->lowonganService->perbarui($lowongan, $request->validated());

        return redirect()
            ->route('pemberi-kerja.lowongan.index')
            ->with('success', 'Lowongan berhasil diperbarui.');
    }

    public function destroy(Request $request, Lowongan $lowongan): RedirectResponse
    {
        $this->pastikanPemilik($request, $lowongan);

        try {
            $this->lowonganService->hapus($lowongan);
        } catch (\RuntimeException $e) {
            return redirect()
                ->route('pemberi-kerja.lowongan.index')
                ->with('error', $e->getMessage());
        }

        return redirect()
            ->route('pemberi-kerja.lowongan.index')
            ->with('success', 'Lowongan berhasil dihapus.');
    }

    /**
     * Toggle status lowongan dibuka <-> ditutup (manual oleh pemberi kerja,
     * terpisah dari auto-close via LamaranService::terima()).
     */
    public function toggleStatus(Request $request, Lowongan $lowongan): RedirectResponse
    {
        $this->pastikanPemilik($request, $lowongan);

        $statusBaru = $lowongan->status === 'dibuka' ? 'ditutup' : 'dibuka';
        $lowongan->update(['status' => $statusBaru]);

        return redirect()
            ->back()
            ->with('success', "Status lowongan diubah menjadi {$statusBaru}.");
    }

    private function pastikanPemilik(Request $request, Lowongan $lowongan): void
    {
        /** @var \App\Models\User $user */
        $user = $request->user();

        abort_if($lowongan->id_pemberi_kerja !== $user->id, 403);
    }
}
