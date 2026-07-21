<?php

namespace App\Http\Controllers\PencariKerja;

use App\Http\Controllers\Controller;
use App\Models\Lowongan;
use App\Services\LowonganTersimpanService;
use Illuminate\Http\Request;

class LowonganTersimpanController extends Controller
{
    public function __construct(protected LowonganTersimpanService $lowonganTersimpanService) {}

    public function index(Request $request)
    {
        /** @var \App\Models\User $user */
        $user = $request->user();

        $lowonganTersimpan = $user->lowonganTersimpan()
            ->with('lowongan')
            ->latest()
            ->paginate(10);

        return view('pencari-kerja.lowongan-tersimpan', [
            'tersimpan' => $lowonganTersimpan,
        ]);
    }

    public function toggle(Request $request, Lowongan $lowongan)
    {
        /** @var \App\Models\User $user */
        $user = $request->user();

        $tersimpan = $this->lowonganTersimpanService->toggle($user, $lowongan);

        return response()->json([
            'sukses' => true,
            'tersimpan' => $tersimpan,
        ]);
    }

    public function hapus(Request $request, Lowongan $lowongan)
    {
        /** @var \App\Models\User $user */
        $user = $request->user();

        $this->lowonganTersimpanService->toggle($user, $lowongan);

        return response()->json(['sukses' => true]);
    }
}
