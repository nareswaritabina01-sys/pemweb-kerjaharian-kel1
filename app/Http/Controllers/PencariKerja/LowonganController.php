<?php

namespace App\Http\Controllers\PencariKerja;

use App\Http\Controllers\Controller;
use App\Models\Kategori;
use App\Models\Lowongan;
use App\Models\User;
use App\Services\LowonganService;
use Illuminate\Http\Request;
use Illuminate\View\View;

class LowonganController extends Controller
{
    public function __construct(protected LowonganService $lowonganService) {}

    public function index(Request $request): View
    {
        /** @var User|null $user */
        $user = $request->user();

        $filter = $request->only(['pencarian', 'kategori', 'latitude', 'longitude', 'radius']);

        if (! empty($filter['kategori'])) {
            $filter['kategori_id'] = $filter['kategori'];
            unset($filter['kategori']);
        }

        $lowongan = $this->lowonganService->cari($filter, $user);
        $kategoriList = Kategori::orderBy('nama')->get();

        return view('pencari-kerja.lowongan.index', compact('lowongan', 'kategoriList', 'filter'));
    }

    public function show(Request $request, Lowongan $lowongan): View
    {
        /** @var User $user */
        $user = $request->user();

        $lowongan = $this->lowonganService->detail($lowongan->id);

        $sudahMelamar = $lowongan->lamaran()
            ->where('id_pencari_kerja', $user->id)
            ->exists();

        $sudahTersimpan = $user->lowonganTersimpan()
            ->where('id_lowongan', $lowongan->id)
            ->exists();

        return view('pencari-kerja.lowongan.show', compact('lowongan', 'sudahMelamar', 'sudahTersimpan'));
    }
}
