<?php

namespace App\Services;

use App\Models\User;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Storage;

class ProfilService
{
    public function perbarui(User $user, array $data): User
    {
        $user->update($data);
        return $user;
    }

    public function perbaruiFoto(User $user, UploadedFile $foto): User
    {
        if ($user->foto_profil) {
            Storage::disk('public')->delete($user->foto_profil);
        }

        $path = $foto->store('foto-profil', 'public');
        $user->update(['foto_profil' => $path]);

        return $user;
    }
}
