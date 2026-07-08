<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    use WithoutModelEvents;

    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // User default untuk login testing (role default: freelancer)
        User::factory()->create([
            'name' => 'Test User',
            'email' => 'test@example.com',
        ]);

        // User client untuk pemilik lowongan (dibutuhkan oleh VacancySeeder)
        User::factory()->create([
            'name' => 'Client Demo',
            'email' => 'client@example.com',
            'role' => 'client',
        ]);

        // User admin untuk keperluan review/dispute
        User::factory()->create([
            'name' => 'Admin',
            'email' => 'admin@example.com',
            'role' => 'admin',
        ]);

        $this->call([
            VacancySeeder::class,
        ]);
    }
}