<?php
// database/seeders/KategoriSeeder.php

namespace Database\Seeders;

use App\Models\Kategori;
use Illuminate\Database\Seeder;

class KategoriSeeder extends Seeder
{
    public function run(): void
    {
        $daftar = [
            'Pertukangan',
            'ART',
            'Buruh Harian',
            'Supir',
            'Security',
            'Tukang Kebun',
            'Laundry',
            'Lainnya',
        ];

        foreach ($daftar as $nama) {
            Kategori::firstOrCreate(['nama' => $nama]);
        }
    }
}