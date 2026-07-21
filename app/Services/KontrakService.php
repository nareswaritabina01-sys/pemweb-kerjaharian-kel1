<?php

namespace App\Services;

use App\Models\Kontrak;
use App\Models\User;
use App\Models\Notifikasi;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Storage;
use Illuminate\Validation\ValidationException;

class KontrakService
{
    /**
     * Ambil kontrak milik pemberi kerja (lintas lowongan), dengan filter status opsional.
     */
    public function milikPemberiKerja(User $pemberiKerja, ?string $status = null): LengthAwarePaginator
    {
        $query = Kontrak::whereHas('lamaran.lowongan', function ($q) use ($pemberiKerja) {
            $q->where('id_pemberi_kerja', $pemberiKerja->id);
        })
            ->with(['lamaran.pencariKerja', 'lamaran.lowongan'])
            ->latest();

        if ($status) {
            $query->where('status', $status);
        }

        return $query->paginate(10)->withQueryString();
    }

    public function detail(int $id, User $pemberiKerja): Kontrak
    {
        $kontrak = Kontrak::with(['lamaran.pencariKerja', 'lamaran.lowongan'])->findOrFail($id);

        if ($kontrak->lamaran->lowongan->id_pemberi_kerja !== $pemberiKerja->id) {
            abort(403);
        }

        return $kontrak;
    }

    /**
     * Pemberi kerja menandai pekerjaan selesai (belum tentu sudah dibayar).
     */
    public function tandaiSelesai(Kontrak $kontrak): Kontrak
    {
        if ($kontrak->status !== 'berlangsung') {
            throw ValidationException::withMessages([
                'status' => 'Kontrak ini tidak dalam status berlangsung.',
            ]);
        }

        $kontrak->update([
            'status' => 'selesai',
            'dikonfirmasi_pemberi_kerja' => true,
            'selesai_pada' => now(),
        ]);

        // Buat notifikasi untuk pencari kerja
        $pencari = $kontrak->lamaran->pencariKerja;
        if ($pencari) {
            Notifikasi::create([
                'user_id' => $pencari->id,
                'tipe' => 'kontrak',
                'judul' => 'Pekerjaan ditandai selesai',
                'pesan' => 'Pemberi kerja telah menandai pekerjaan sebagai selesai. Periksa detail kontrak.',
                'link' => route('pencari-kerja.notifikasi'),
                'data' => ['kontrak_id' => $kontrak->id],
            ]);
        }

        return $kontrak;
    }

    public function unggahBuktiTransfer(Kontrak $kontrak, UploadedFile $bukti): Kontrak
    {
        if ($kontrak->status !== 'selesai') {
            throw ValidationException::withMessages([
                'status' => 'Bukti transfer hanya bisa diunggah setelah pekerjaan ditandai selesai.',
            ]);
        }

        if ($kontrak->bukti_transfer) {
            Storage::disk('public')->delete($kontrak->bukti_transfer);
        }

        $path = $bukti->store('bukti-transfer', 'public');
        $kontrak->update(['bukti_transfer' => $path]);

        return $kontrak;
    }

    public function konfirmasiDibayar(Kontrak $kontrak): Kontrak
    {
        if ($kontrak->status !== 'selesai') {
            throw ValidationException::withMessages([
                'status' => 'Kontrak hanya dapat dikonfirmasi dibayar jika statusnya selesai.',
            ]);
        }

        $kontrak->update([
            'status' => 'dibayar',
            'dikonfirmasi_pencari_kerja' => true,
            'dibayar_pada' => now(),
        ]);

        // Notifikasi untuk pemberi kerja
        $pemberi = $kontrak->lamaran->lowongan->pemberiKerja;
        if ($pemberi) {
            Notifikasi::create([
                'user_id' => $pemberi->id,
                'tipe' => 'kontrak',
                'judul' => 'Pembayaran dikonfirmasi',
                'pesan' => 'Pencari kerja telah mengonfirmasi pembayaran untuk kontrak ini.',
                'link' => route('pemberi-kerja.kontrak.show', $kontrak->id),
                'data' => ['kontrak_id' => $kontrak->id],
            ]);
        }

        // Konfirmasi untuk pencari (opsional)
        $pencari = $kontrak->lamaran->pencariKerja;
        if ($pencari) {
            Notifikasi::create([
                'user_id' => $pencari->id,
                'tipe' => 'kontrak',
                'judul' => 'Pembayaran tercatat',
                'pesan' => 'Pembayaran berhasil dikonfirmasi dan kontrak berstatus dibayar.',
                'link' => route('pencari-kerja.notifikasi'),
                'data' => ['kontrak_id' => $kontrak->id],
            ]);
        }

        return $kontrak;
    }

    public function ajukanSengketa(Kontrak $kontrak): Kontrak
    {
        if (! in_array($kontrak->status, ['selesai', 'dibayar'])) {
            throw ValidationException::withMessages([
                'status' => 'Sengketa hanya dapat diajukan untuk kontrak yang telah selesai atau sudah dibayar.',
            ]);
        }

        $kontrak->update([
            'status' => 'sengketa',
        ]);

        // Notifikasi ke pemberi kerja
        $pemberi = $kontrak->lamaran->lowongan->pemberiKerja;
        if ($pemberi) {
            Notifikasi::create([
                'user_id' => $pemberi->id,
                'tipe' => 'sengketa',
                'judul' => 'Kontrak diajukan sengketa',
                'pesan' => 'Kontrak telah diajukan sengketa oleh pihak lain. Mohon tinjau dan berikan informasi.',
                'link' => route('pemberi-kerja.kontrak.show', $kontrak->id),
                'data' => ['kontrak_id' => $kontrak->id],
            ]);
        }

        // Notifikasi ke admin
        $admins = User::admin()->get();
        foreach ($admins as $admin) {
            Notifikasi::create([
                'user_id' => $admin->id,
                'tipe' => 'sengketa',
                'judul' => 'Sengketa kontrak diajukan',
                'pesan' => 'Sebuah kontrak telah diajukan sengketa dan membutuhkan peninjauan admin.',
                'link' => route('admin.dashboard'),
                'data' => ['kontrak_id' => $kontrak->id],
            ]);
        }

        return $kontrak;
    }
}
