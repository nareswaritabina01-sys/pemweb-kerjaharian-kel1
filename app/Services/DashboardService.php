<?php

namespace App\Services;

use App\Models\Kontrak;
use App\Models\Lamaran;
use App\Models\Lowongan;
use App\Models\User;
use Illuminate\Database\Eloquent\Collection;

class DashboardService
{
    /**
     * Ambil seluruh data statistik & ringkasan untuk Dashboard Pemberi Kerja.
     *
     * @return array{
     *     total_lowongan_aktif: int,
     *     total_pelamar: int,
     *     kontrak_aktif: int,
     *     menunggu_pembayaran: int,
     *     pelamar_terbaru: Collection<int, Lamaran>,
     * }
     */
    public function untukPemberiKerja(User $pemberiKerja): array
    {
        $idLowonganMilikSendiri = Lowongan::where('id_pemberi_kerja', $pemberiKerja->id)
            ->pluck('id');

        $totalLowonganAktif = Lowongan::where('id_pemberi_kerja', $pemberiKerja->id)
            ->where('status', 'dibuka')
            ->count();

        $totalPelamar = Lamaran::whereIn('id_lowongan', $idLowonganMilikSendiri)->count();

        $kontrakAktif = Kontrak::whereHas('lamaran', function ($query) use ($idLowonganMilikSendiri) {
            $query->whereIn('id_lowongan', $idLowonganMilikSendiri);
        })->where('status', 'berlangsung')->count();

        $menungguPembayaran = Kontrak::whereHas('lamaran', function ($query) use ($idLowonganMilikSendiri) {
            $query->whereIn('id_lowongan', $idLowonganMilikSendiri);
        })->where('status', 'selesai')->count();

        $pelamarTerbaru = Lamaran::whereIn('id_lowongan', $idLowonganMilikSendiri)
            ->with(['pencariKerja', 'lowongan'])
            ->latest()
            ->limit(5)
            ->get();

        return [
            'total_lowongan_aktif' => $totalLowonganAktif,
            'total_pelamar' => $totalPelamar,
            'kontrak_aktif' => $kontrakAktif,
            'menunggu_pembayaran' => $menungguPembayaran,
            'pelamar_terbaru' => $pelamarTerbaru,
        ];
    }
}
