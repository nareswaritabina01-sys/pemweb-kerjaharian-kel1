<?php

namespace App\Http\Controllers\PemberiKerja;

use App\Http\Controllers\Controller;
use App\Http\Requests\ProfilPemberiKerjaRequest;
use App\Services\ProfilService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ProfilController extends Controller
{
    public function edit()
    {
        $user = Auth::user();

        return view('pemberi-kerja.profil', compact('user'));
    }

    public function update(
        ProfilPemberiKerjaRequest $request,
        ProfilService $profilService
    ) {
        $data = $request->validated();
        $user = Auth::user();

        if ($user) {
            $profilService->perbarui($user, $data);
        }

        return back()->with('success', 'Profil diperbarui.');
    }

    public function updateFoto(
        Request $request,
        ProfilService $profilService
    ) {
        $request->validate([
            'foto_profil' => 'required|image|max:2048',
        ]);

        $file = $request->file('foto_profil');
        $user = Auth::user();

        if ($user && $file) {
            $profilService->perbaruiFoto($user, $file);
        }

        return back()->with('success', 'Foto profil diperbarui.');
    }
}