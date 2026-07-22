<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    public function run(): void
    {
        // Titik pusat: sekitar Padalarang, Jawa Barat
        $pusatLat = -6.8385;
        $pusatLng = 107.4855;

        // ===== Pemberi Kerja =====
        $pemberiKerja = [
            [
                'nama' => 'Budi Santoso',
                'email' => 'budi@kerjaharian.test',
                'latitude' => $pusatLat + 0.01,
                'longitude' => $pusatLng + 0.01,
                'no_telepon' => '081234567801',
                'alamat' => 'Jl. Raya Padalarang No. 10',
            ],
            [
                'nama' => 'Siti Aminah',
                'email' => 'siti@kerjaharian.test',
                'latitude' => $pusatLat + 0.03,
                'longitude' => $pusatLng - 0.02,
                'no_telepon' => '081234567802',
                'alamat' => 'Jl. Cihampelas No. 25',
            ],
            [
                'nama' => 'CV Maju Jaya',
                'email' => 'majujaya@kerjaharian.test',
                'latitude' => $pusatLat - 0.08,
                'longitude' => $pusatLng + 0.09,
                'no_telepon' => '081234567803',
                'alamat' => 'Jl. Soekarno Hatta No. 100, Bandung',
            ],
        ];

        foreach ($pemberiKerja as $data) {
            User::updateOrCreate(
                ['email' => $data['email']],
                [
                    'nama' => $data['nama'],
                    'password' => Hash::make('password'),
                    'role' => 'pemberi_kerja',
                    'latitude' => $data['latitude'],
                    'longitude' => $data['longitude'],
                    'no_telepon' => $data['no_telepon'],
                    'alamat' => $data['alamat'],
                    'status_akun' => 'aktif',
                ]
            );
        }

        // ===== Pencari Kerja =====
        $pencariKerja = [
            [
                'nama' => 'Andi Wijaya',
                'email' => 'andi@kerjaharian.test',
                'latitude' => $pusatLat,
                'longitude' => $pusatLng,
                'no_telepon' => '081234567811',
                'alamat' => 'Jl. Melati No. 5, Padalarang',
                'bank' => true,
            ],
            [
                'nama' => 'Dewi Lestari',
                'email' => 'dewi@kerjaharian.test',
                'latitude' => $pusatLat + 0.005,
                'longitude' => $pusatLng + 0.008,
                'no_telepon' => '081234567812',
                'alamat' => 'Jl. Anggrek No. 8, Padalarang',
                'bank' => true,
            ],
            [
                'nama' => 'Rian Hidayat',
                'email' => 'rian@kerjaharian.test',
                'latitude' => $pusatLat - 0.2,
                'longitude' => $pusatLng + 0.25,
                'no_telepon' => '081234567813',
                'alamat' => 'Jl. Dago No. 50, Bandung (jauh, luar radius 5km)',
                'bank' => false,
            ],
        ];

        foreach ($pencariKerja as $data) {
            User::updateOrCreate(
                ['email' => $data['email']],
                [
                    'nama' => $data['nama'],
                    'password' => Hash::make('password'),
                    'role' => 'pencari_kerja',
                    'latitude' => $data['latitude'],
                    'longitude' => $data['longitude'],
                    'no_telepon' => $data['no_telepon'],
                    'alamat' => $data['alamat'],
                    'nama_bank' => $data['bank'] ? 'Bank BCA' : null,
                    'nomor_rekening' => $data['bank'] ? '1234567890' : null,
                    'nama_pemilik_rekening' => $data['bank'] ? $data['nama'] : null,
                    'status_akun' => 'aktif',
                ]
            );
        }
    }
}
