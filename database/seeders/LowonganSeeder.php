<?php

namespace Database\Seeders;

use App\Models\Lowongan;
use App\Models\User;
use Illuminate\Database\Seeder;

class LowonganSeeder extends Seeder
{
    public function run(): void
    {
        $budi = User::where('email', 'budi@kerjaharian.test')->first();
        $siti = User::where('email', 'siti@kerjaharian.test')->first();
        $majuJaya = User::where('email', 'majujaya@kerjaharian.test')->first();

        if (!$budi || !$siti || !$majuJaya) {
            $this->command->warn('User pemberi kerja belum ada, jalankan UserSeeder dulu.');
            return;
        }

        $pusatLat = -6.8385;
        $pusatLng = 107.4855;

        $daftarLowongan = [
            // Dalam radius 5km dari Andi/Dewi
            [
                'id_pemberi_kerja' => $budi->id,
                'judul' => 'Tukang Bersih Rumah Harian',
                'nama_perusahaan' => null,
                'lokasi' => 'Padalarang, Jawa Barat',
                'latitude' => $pusatLat + 0.01,
                'longitude' => $pusatLng + 0.01,
                'upah' => 100000,
                'satuan_upah' => 'harian',
                'kategori' => 'Kebersihan',
                'deskripsi' => "Dibutuhkan tenaga bersih-bersih rumah 2 lantai.\nJam kerja 08:00-12:00.\nDisediakan alat kebersihan.",
                'kuota_pekerja' => 2,
                'status' => 'dibuka',
            ],
            [
                'id_pemberi_kerja' => $siti->id,
                'judul' => 'Kuli Angkut Barang Pindahan',
                'nama_perusahaan' => null,
                'lokasi' => 'Cihampelas, Bandung',
                'latitude' => $pusatLat + 0.03,
                'longitude' => $pusatLng - 0.02,
                'upah' => 150000,
                'satuan_upah' => 'harian',
                'kategori' => 'Angkut Barang',
                'deskripsi' => "Bantu angkut barang pindahan rumah.\nEstimasi selesai 1 hari.\nDiutamakan yang berpengalaman.",
                'kuota_pekerja' => 3,
                'status' => 'dibuka',
            ],
            [
                'id_pemberi_kerja' => $budi->id,
                'judul' => 'Tukang Cat Pagar',
                'nama_perusahaan' => null,
                'lokasi' => 'Padalarang, Jawa Barat',
                'latitude' => $pusatLat + 0.008,
                'longitude' => $pusatLng + 0.012,
                'upah' => 300000,
                'satuan_upah' => 'borongan',
                'kategori' => 'Pertukangan',
                'deskripsi' => "Cat ulang pagar rumah sepanjang 15 meter.\nCat disediakan pemberi kerja.",
                'kuota_pekerja' => 1,
                'status' => 'dibuka',
            ],
            // Di luar radius 5km (untuk tes filter radius)
            [
                'id_pemberi_kerja' => $majuJaya->id,
                'judul' => 'Buruh Gudang Harian',
                'nama_perusahaan' => 'CV Maju Jaya',
                'lokasi' => 'Soekarno Hatta, Bandung',
                'latitude' => $pusatLat - 0.08,
                'longitude' => $pusatLng + 0.09,
                'upah' => 120000,
                'satuan_upah' => 'harian',
                'kategori' => 'Gudang',
                'deskripsi' => "Bongkar muat barang gudang.\nJam kerja 07:00-15:00.",
                'kuota_pekerja' => 5,
                'status' => 'dibuka',
            ],
            // Lowongan tertutup (untuk tes status)
            [
                'id_pemberi_kerja' => $siti->id,
                'judul' => 'Tukang Masak Acara Hajatan',
                'nama_perusahaan' => null,
                'lokasi' => 'Cihampelas, Bandung',
                'latitude' => $pusatLat + 0.03,
                'longitude' => $pusatLng - 0.02,
                'upah' => 250000,
                'satuan_upah' => 'harian',
                'kategori' => 'Katering',
                'deskripsi' => "Sudah tidak menerima pelamar, kuota terpenuhi.",
                'kuota_pekerja' => 1,
                'status' => 'ditutup',
            ],
        ];

        foreach ($daftarLowongan as $data) {
            Lowongan::updateOrCreate(
                [
                    'id_pemberi_kerja' => $data['id_pemberi_kerja'],
                    'judul' => $data['judul'],
                ],
                $data
            );
        }
    }
}
