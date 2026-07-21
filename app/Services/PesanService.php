<?php

namespace App\Services;

use App\Models\Percakapan;
use App\Models\Pesan;
use App\Models\User;
use App\Models\Notifikasi;
use Illuminate\Support\Str;
use Illuminate\Auth\Access\AuthorizationException;
use Illuminate\Support\Collection;

class PesanService
{
    /**
     * Kirim pesan baru ke sebuah percakapan.
     * Validasi bahwa pengirim adalah salah satu pihak yang berhak (pencari kerja / pemberi kerja).
     */
    public function kirim(Percakapan $percakapan, User $pengirim, string $isi): Pesan
    {
        $this->pastikanPesertaPercakapan($percakapan, $pengirim);

        $pesan = Pesan::create([
            'id_percakapan' => $percakapan->id,
            'id_pengirim'   => $pengirim->id,
            'isi'           => $isi,
        ]);

        // Buat notifikasi untuk penerima
        $penerima = $percakapan->lawanBicara($pengirim);
        if ($penerima) {
            Notifikasi::create([
                'user_id' => $penerima->id,
                'tipe' => 'pesan',
                'judul' => 'Pesan baru dari ' . $pengirim->nama,
                'pesan' => Str::limit($isi, 150),
                'link' => route('pesan.show', $percakapan->id),
                'data' => ['percakapan_id' => $percakapan->id],
            ]);
        }

        return $pesan->load('pengirim');
    }

    /**
     * Ambil pesan-pesan baru setelah id tertentu (dipakai untuk polling).
     */
    public function ambilBaru(Percakapan $percakapan, int $sejakId): Collection
    {
        return Pesan::where('id_percakapan', $percakapan->id)
            ->where('id', '>', $sejakId)
            ->with('pengirim')
            ->orderBy('id')
            ->get();
    }

    /**
     * Tandai seluruh pesan lawan bicara (bukan milik $pembaca) sebagai sudah dibaca.
     */
    public function tandaiDibaca(Percakapan $percakapan, User $pembaca): void
    {
        Pesan::where('id_percakapan', $percakapan->id)
            ->where('id_pengirim', '!=', $pembaca->id)
            ->whereNull('dibaca_pada')
            ->update(['dibaca_pada' => now()]);
    }

    /**
     * Pastikan user adalah pencari kerja atau pemberi kerja dari percakapan ini.
     */
    protected function pastikanPesertaPercakapan(Percakapan $percakapan, User $user): void
    {
        $lamaran = $percakapan->lamaran;

        $idPencariKerja  = $lamaran->id_pencari_kerja;
        $idPemberiKerja  = $lamaran->lowongan->id_pemberi_kerja;

        if ($user->id !== $idPencariKerja && $user->id !== $idPemberiKerja) {
            throw new AuthorizationException('Anda bukan peserta percakapan ini.');
        }
    }
}
