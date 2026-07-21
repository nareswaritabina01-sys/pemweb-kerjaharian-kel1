<?php

namespace App\Http\Controllers\PencariKerja;

use App\Http\Controllers\Controller;
use App\Models\Lamaran;
use App\Models\User;
use App\Services\LowonganService;
use Illuminate\Http\Request;
use Illuminate\Pagination\LengthAwarePaginator;
use Illuminate\View\View;

class DashboardController extends Controller
{
    public function __construct(protected LowonganService $lowonganService) {}

    public function index(Request $request): View
    {
        /** @var User $user */
        $user = $request->user();

        $statistik = [
            'aktif' => Lamaran::where('id_pencari_kerja', $user->id)->menunggu()->count(),
            'diterima' => Lamaran::where('id_pencari_kerja', $user->id)->diterima()->count(),
            'ditolak' => Lamaran::where('id_pencari_kerja', $user->id)->ditolak()->count(),
        ];

        /** @var LengthAwarePaginator $rekomendasiPaginator */
        $rekomendasiPaginator = $this->lowonganService->cari(
            ['latitude' => $user->latitude, 'longitude' => $user->longitude, 'radius' => 5],
            $user
        );

        return view('pencari-kerja.dashboard.index', [
            'user' => $user,
            'statistik' => $statistik,
            'rekomendasi' => $rekomendasiPaginator->take(2),
        ]);
    }
}
