<?php

namespace App\Services;

use App\Models\Kontrak;
use App\Models\Lamaran;
use App\Models\Lowongan;
use App\Models\Percakapan;
use App\Models\User;
use Illuminate\Support\Facades\DB;
use Illuminate\Validation\ValidationException;

class LamaranService
{
    /**
     * Pencari kerja mengajukan lamaran ke sebuah lowongan.
     */
    public function ajukan(User $pencariKerja, Lowongan $lowongan, ?string $pesan = null): Lamaran
    {
        if (! $pencariKerja->isPencariKerja()) {
            throw ValidationException::withMessages([
                'role' => 'Hanya akun Pencari Kerja yang dapat mengajukan lamaran.',
            ]);
        }

        if ($lowongan->status !== 'dibuka' || $lowongan->sisa_kuota <= 0) {
            throw ValidationException::withMessages([
                'lowongan' => 'Lowongan ini sudah tidak menerima lamaran baru.',
            ]);
        }

        $sudahMelamar = Lamaran::where('id_pencari_kerja', $pencariKerja->id)
            ->where('id_lowongan', $lowongan->id)
            ->exists();

        if ($sudahMelamar) {
            throw ValidationException::withMessages([
                'lowongan' => 'Anda sudah pernah melamar ke lowongan ini.',
            ]);
        }

        return Lamaran::create([
            'id_pencari_kerja' => $pencariKerja->id,
            'id_lowongan' => $lowongan->id,
            'pesan' => $pesan,
            'status' => 'menunggu',
        ]);
    }

    /**
     * Pemberi kerja menerima lamaran -> otomatis buat Kontrak + Percakapan.
     * Jika kuota lowongan terpenuhi setelah ini, lowongan otomatis ditutup.
     */
    public function terima(Lamaran $lamaran): Lamaran
    {
        return DB::transaction(function () use ($lamaran) {
            $lamaran->update(['status' => 'diterima']);

            Kontrak::create([
                'id_lamaran' => $lamaran->id,
                'status' => 'berlangsung',
            ]);

            Percakapan::create([
                'id_lamaran' => $lamaran->id,
            ]);

            // Auto-tutup lowongan kalau kuota sudah terpenuhi
            $lowongan = $lamaran->lowongan;
            if ($lowongan->sisa_kuota <= 0) {
                $lowongan->update(['status' => 'ditutup']);
            }

            return $lamaran->fresh(['kontrak', 'percakapan']);
        });
    }

    public function tolak(Lamaran $lamaran): Lamaran
    {
        $lamaran->update(['status' => 'ditolak']);
        return $lamaran;
    }

    public function riwayat(User $pencariKerja)
    {
        return Lamaran::with('lowongan.pemberiKerja')
            ->where('id_pencari_kerja', $pencariKerja->id)
            ->latest()
            ->paginate(10);
    }
}
