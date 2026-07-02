<?php

namespace Database\Seeders;

use App\Models\Vacancy;
use Illuminate\Database\Seeder;

class VacancySeeder extends Seeder
{
    public function run(): void
    {
        Vacancy::truncate();

        Vacancy::create([
            'title' => 'Tukang Kayu',
            'company' => 'PT Bangun Sejahtera',
            'location' => 'Jakarta Selatan',
            'salary' => 150000,
            'category' => 'Pertukangan',
            'description' => 'Dibutuhkan tukang kayu berpengalaman untuk pekerjaan pembuatan dan pemasangan berbagai konstruksi kayu di proyek perumahan.'
        ]);

        Vacancy::create([
            'title' => 'Tukang Cat',
            'company' => 'CV Warna Indah',
            'location' => 'Bekasi',
            'salary' => 130000,
            'category' => 'Pertukangan',
            'description' => 'Mengecat dinding interior dan eksterior bangunan dengan rapi, efisien, dan memperhatikan detail kebersihan.'
        ]);

        Vacancy::create([
            'title' => 'Tukang Listrik',
            'company' => 'PT Terang Abadi',
            'location' => 'Depok',
            'salary' => 160000,
            'category' => 'Pertukangan',
            'description' => 'Melakukan instalasi jalur kabel baru, pemasangan saklar, lampu, dan perbaikan jaringan listrik yang bermasalah.'
        ]);

        Vacancy::create([
            'title' => 'Tukang Bangunan',
            'company' => 'PT Maju Bersama',
            'location' => 'Tangerang',
            'salary' => 170000,
            'category' => 'Pertukangan',
            'description' => 'Membantu pekerjaan konstruksi dasar, pemasangan batu bata, plesteran dinding, dan pengecoran lantai.'
        ]);
    }
}