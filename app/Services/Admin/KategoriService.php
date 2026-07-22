<?php

namespace App\Services\Admin;

use App\Models\Kategori;
use Illuminate\Database\Eloquent\Collection;

class KategoriService
{
    public function semua(): Collection
    {
        return Kategori::withCount('lowongan')->orderBy('nama')->get();
    }

    public function buat(array $data): Kategori
    {
        return Kategori::create($data);
    }

    public function perbarui(Kategori $kategori, array $data): Kategori
    {
        $kategori->update($data);

        return $kategori;
    }

    public function hapus(Kategori $kategori): void
    {
        if ($kategori->lowongan()->exists()) {
            throw new \RuntimeException('Kategori tidak bisa dihapus karena masih digunakan oleh lowongan.');
        }

        $kategori->delete();
    }
}
