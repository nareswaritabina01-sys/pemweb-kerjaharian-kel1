<?php

namespace App\Services;

use App\Models\Lowongan;
use App\Models\LowonganTersimpan;
use App\Models\User;

class LowonganTersimpanService
{
    /**
     * Toggle simpan/batal simpan lowongan untuk user tertentu.
     * Return true kalau sekarang tersimpan, false kalau baru saja dihapus.
     */
    public function toggle(User $user, Lowongan $lowongan): bool
    {
        $existing = LowonganTersimpan::where('id_pencari_kerja', $user->id)
            ->where('id_lowongan', $lowongan->id)
            ->first();

        if ($existing) {
            $existing->delete();
            return false;
        }

        LowonganTersimpan::create([
            'id_pencari_kerja' => $user->id,
            'id_lowongan'      => $lowongan->id,
        ]);

        return true;
    }
}
