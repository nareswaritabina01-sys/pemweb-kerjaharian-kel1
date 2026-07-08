<?php

namespace Database\Seeders;

use App\Models\User;
use App\Models\Vacancy;
use Illuminate\Database\Seeder;

class VacancySeeder extends Seeder
{
    public function run(): void
    {
        // Tidak perlu truncate: migrate:fresh sudah menjamin tabel kosong.
        // Kalau nanti seeder ini dijalankan sendiri via `php artisan db:seed --class=VacancySeeder`
        // tanpa fresh migrate, gunakan Vacancy::query()->delete() saja (aman terhadap FK).

        // Ambil client yang sudah dibuat di DatabaseSeeder
        $client = User::where('email', 'client@example.com')->first();

        Vacancy::create([
            'user_id' => $client->id,
            'title' => 'Tukang Kayu',
            'company' => 'PT Bangun Sejahtera',
            'location' => 'Jakarta Selatan',
            'latitude' => -6.2615,
            'longitude' => 106.8106,
            'salary' => 150000,
            'category' => 'Pertukangan',
            'description' => 'Dibutuhkan tukang kayu berpengalaman untuk pekerjaan pembuatan dan pemasangan berbagai konstruksi kayu di proyek perumahan.'
        ]);

        Vacancy::create([
            'user_id' => $client->id,
            'title' => 'Tukang Cat',
            'company' => 'CV Warna Indah',
            'location' => 'Bekasi',
            'latitude' => -6.2383,
            'longitude' => 106.9756,
            'salary' => 130000,
            'category' => 'Pertukangan',
            'description' => 'Mengecat dinding interior dan eksterior bangunan dengan rapi, efisien, dan memperhatikan detail kebersihan.'
        ]);

        Vacancy::create([
            'user_id' => $client->id,
            'title' => 'Tukang Listrik',
            'company' => 'PT Terang Abadi',
            'location' => 'Depok',
            'latitude' => -6.4025,
            'longitude' => 106.7942,
            'salary' => 160000,
            'category' => 'Pertukangan',
            'description' => 'Melakukan instalasi jalur kabel baru, pemasangan saklar, lampu, dan perbaikan jaringan listrik yang bermasalah.'
        ]);

        Vacancy::create([
            'user_id' => $client->id,
            'title' => 'Tukang Bangunan',
            'company' => 'PT Maju Bersama',
            'location' => 'Tangerang',
            'latitude' => -6.1783,
            'longitude' => 106.6319,
            'salary' => 170000,
            'category' => 'Pertukangan',
            'description' => 'Membantu pekerjaan konstruksi dasar, pemasangan batu bata, plesteran dinding, dan pengecoran lantai.'
        ]);
    }
}