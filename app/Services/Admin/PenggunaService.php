<?php

namespace App\Services\Admin;

use App\Models\User;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;

class PenggunaService
{
    public function semua(array $filter = []): LengthAwarePaginator
    {
        $query = User::query()
            ->whereIn('role', ['pemberi_kerja', 'pencari_kerja']);

        if (! empty($filter['role'])) {
            $query->where('role', $filter['role']);
        }

        if (! empty($filter['status_akun'])) {
            $query->where('status_akun', $filter['status_akun']);
        }

        if (! empty($filter['cari'])) {
            $kataKunci = $filter['cari'];
            $query->where(function ($q) use ($kataKunci) {
                $q->where('nama', 'like', "%{$kataKunci}%")
                    ->orWhere('email', 'like', "%{$kataKunci}%");
            });
        }

        return $query->latest()->paginate(10)->withQueryString();
    }

    public function ubahStatus(User $pengguna, string $statusBaru): void
    {
        if ($pengguna->isAdmin()) {
            abort(403, 'Status akun Admin tidak dapat diubah.');
        }

        $pengguna->update(['status_akun' => $statusBaru]);
    }
}
