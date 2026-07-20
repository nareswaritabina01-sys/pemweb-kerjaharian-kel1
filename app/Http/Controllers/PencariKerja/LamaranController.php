<?php

namespace App\Http\Controllers\PencariKerja;

use App\Http\Controllers\Controller;
use App\Http\Requests\LamaranRequest;
use App\Models\Lamaran;
use App\Models\Lowongan;
use App\Models\User;
use App\Services\LamaranService;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;

class LamaranController extends Controller
{
    public function __construct(protected LamaranService $lamaranService) {}

    public function index(Request $request): View
    {
        /** @var User $user */
        $user = $request->user();

        $status = $request->query('status');

        $lamaran = Lamaran::with('lowongan.pemberiKerja', 'kontrak')
            ->where('id_pencari_kerja', $user->id)
            ->when($status, fn($q) => $q->where('status', $status))
            ->latest()
            ->paginate(10)
            ->withQueryString();

        $jumlah = [
            'semua' => Lamaran::where('id_pencari_kerja', $user->id)->count(),
            'menunggu' => Lamaran::where('id_pencari_kerja', $user->id)->menunggu()->count(),
            'diterima' => Lamaran::where('id_pencari_kerja', $user->id)->diterima()->count(),
            'ditolak' => Lamaran::where('id_pencari_kerja', $user->id)->ditolak()->count(),
        ];

        return view('pencari-kerja.lamaran.index', compact('lamaran', 'jumlah', 'status'));
    }

    public function show(Request $request, Lamaran $lamaran): View
    {
        /** @var User $user */
        $user = $request->user();
        abort_unless($lamaran->id_pencari_kerja === $user->id, 403);
        $lamaran->load('lowongan.pemberiKerja', 'kontrak', 'percakapan');
        return view('pencari-kerja.lamaran.show', compact('lamaran'));
    }

    public function store(LamaranRequest $request, Lowongan $lowongan): RedirectResponse
    {
        /** @var User $user */
        $user = $request->user();
        $this->lamaranService->ajukan(
            $user,
            $lowongan,
            $request->validated('pesan')
        );

        return redirect()
            ->route('pencari-kerja.lamaran.index')
            ->with('success', 'Lamaran berhasil dikirim. Silakan tunggu peninjauan dari pemberi kerja.');
    }
}
