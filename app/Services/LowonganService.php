<?php

namespace App\Services;

use App\Models\Lowongan;
use App\Models\User;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;

class LowonganService
{
    /**
     * Cari lowongan dengan filter kata kunci, kategori, dan radius jarak.
     */
    public function cari(array $filter, ?User $user = null): LengthAwarePaginator
    {
        $query = Lowongan::query()->dibuka();

        if (! empty($filter['pencarian'])) {
            $kata = $filter['pencarian'];
            $query->where(function ($q) use ($kata) {
                $q->where('judul', 'like', "%{$kata}%")
                    ->orWhere('deskripsi', 'like', "%{$kata}%")
                    ->orWhere('lokasi', 'like', "%{$kata}%");
            });
        }

        if (! empty($filter['kategori_id'])) {
            $query->denganKategori((int) $filter['kategori_id']);
        }

        $lat = $filter['latitude'] ?? $user?->latitude;
        $lng = $filter['longitude'] ?? $user?->longitude;

        if ($lat && $lng) {
            $radius = $filter['radius'] ?? null;
            $query->terdekat((float) $lat, (float) $lng, $radius ? (float) $radius : null);
        } else {
            $query->latest();
        }

        return $query->paginate(12)->withQueryString();
    }

    public function detail(int $id): Lowongan
    {
        return Lowongan::with(['pemberiKerja', 'kategori'])->findOrFail($id);
    }

    public function buat(User $pemberiKerja, array $data): Lowongan
    {
        return Lowongan::create([
            ...$data,
            'id_pemberi_kerja' => $pemberiKerja->id,
        ]);
    }

    public function perbarui(Lowongan $lowongan, array $data): Lowongan
    {
        $lowongan->update($data);
        return $lowongan;
    }

    public function hapus(Lowongan $lowongan): void
    {
        $adaPelamarDiterima = $lowongan->lamaran()->where('status', 'diterima')->exists();

        if ($adaPelamarDiterima) {
            throw new \RuntimeException('Lowongan tidak bisa dihapus karena sudah memiliki pelamar yang diterima.');
        }

        $lowongan->delete();
    }

    /**
     * Ambil lowongan milik pemberi kerja yang sedang login, dengan filter status opsional.
     */
    public function milikSendiri(User $pemberiKerja, ?string $status = null): LengthAwarePaginator
    {
        $query = Lowongan::where('id_pemberi_kerja', $pemberiKerja->id)
            ->withCount('lamaran')
            ->latest();

        if ($status) {
            $query->where('status', $status);
        }

        return $query->paginate(10)->withQueryString();
    }
}
