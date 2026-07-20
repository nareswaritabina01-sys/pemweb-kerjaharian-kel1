<?php

namespace App\Http\Controllers\PencariKerja;

use App\Http\Controllers\Controller;
use App\Http\Requests\ProfilPencariKerjaRequest;
use App\Models\User;
use App\Services\ProfilService;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;

class ProfilController extends Controller
{
    public function __construct(protected ProfilService $profilService) {}

    public function edit(Request $request): View
    {
        /** @var User $user */
        $user = $request->user();
        return view('pencari-kerja.profil', ['user' => $user]);
    }

    public function update(ProfilPencariKerjaRequest $request): RedirectResponse
    {
        /** @var User $user */
        $user = $request->user();
        $this->profilService->perbarui($user, $request->validated());
        return back()->with('success', 'Profil berhasil diperbarui.');
    }

    public function updateFoto(Request $request): RedirectResponse
    {
        /** @var User $user */
        $user = $request->user();
        $request->validate(['foto_profil' => ['required', 'image', 'max:2048']]);
        $this->profilService->perbaruiFoto($user, $request->file('foto_profil'));
        return back()->with('success', 'Foto profil diperbarui.');
    }
}
