<?php
// app/Services/AuthService.php

namespace App\Services;

use App\Models\User;
use Illuminate\Support\Facades\Hash;

class AuthService
{
    public function registerPemberiKerja(array $data): User
    {
        return User::create([
            'nama' => $data['nama'],
            'email' => $data['email'],
            'password' => Hash::make($data['password']),
            'role' => 'pemberi_kerja',
            'no_telepon' => $data['no_telepon'] ?? null,
            'alamat' => $data['alamat'] ?? null,
        ]);
    }

    public function registerPencariKerja(array $data): User
    {
        return User::create([
            'nama' => $data['nama'],
            'email' => $data['email'],
            'password' => Hash::make($data['password']),
            'role' => 'pencari_kerja',
            'no_telepon' => $data['no_telepon'] ?? null,
            'alamat' => $data['alamat'] ?? null,
        ]);
    }

    public function redirectPath(User $user): string
    {
        return match ($user->role) {
            'admin' => route('admin.dashboard'),
            'pemberi_kerja' => route('pemberi-kerja.dashboard'),
            'pencari_kerja' => route('pencari-kerja.dashboard'),
        };
    }
}