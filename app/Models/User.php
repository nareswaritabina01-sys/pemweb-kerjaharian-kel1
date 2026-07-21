<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Database\Eloquent\Relations\HasMany;

class User extends Authenticatable
{
    use HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'nama',
        'email',
        'password',
        'role',
        'no_telepon',
        'alamat',
        'latitude',
        'longitude',
        'foto_profil',
        'nama_bank',
        'nomor_rekening',
        'nama_pemilik_rekening',
        'status_aktif',
        'bio',
        'nama_usaha',
        'jenis_usaha',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * Get the attributes that should be cast.
     *
     * @return array<string, string>
     */
    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime',
            'password' => 'hashed',
            'status_aktif' => 'boolean',
            'latitude' => 'decimal:7',
            'longitude' => 'decimal:7',
        ];
    }

    // ===== Scope Role =====

    public function scopeAdmin(Builder $query): Builder
    {
        return $query->where('role', 'admin');
    }

    public function scopePemberiKerja(Builder $query): Builder
    {
        return $query->where('role', 'pemberi_kerja');
    }

    public function scopePencariKerja(Builder $query): Builder
    {
        return $query->where('role', 'pencari_kerja');
    }

    public function scopeAktif(Builder $query): Builder
    {
        return $query->where('status_aktif', true);
    }

    // ===== Helper Role (dipakai di Blade & Middleware) =====

    public function isAdmin(): bool
    {
        return $this->role === 'admin';
    }

    public function isPemberiKerja(): bool
    {
        return $this->role === 'pemberi_kerja';
    }

    public function isPencariKerja(): bool
    {
        return $this->role === 'pencari_kerja';
    }

    // ===== Accessor Foto Profil dengan Fallback =====

    public function getFotoProfilUrlAttribute(): string
    {
        return $this->foto_profil
            ? asset('storage/' . $this->foto_profil)
            : asset('images/default-avatar.png');
    }

    // ===== Kelengkapan Profil =====

    public function getKelengkapanProfilAttribute(): int
    {
        if ($this->isPemberiKerja()) {
            $fields = [
                'nama',
                'no_telepon',
                'alamat',
                'foto_profil',
                'bio',
            ];
        } else {
            // Pencari Kerja (default) — termasuk data rekening
            $fields = [
                'nama',
                'no_telepon',
                'alamat',
                'foto_profil',
                'bio',
                'nama_bank',
                'nomor_rekening',
                'nama_pemilik_rekening',
            ];
        }

        $terisi = collect($fields)->filter(fn($f) => filled($this->{$f}))->count();

        return (int) round(($terisi / count($fields)) * 100);
    }

    // ===== Helper Kelengkapan Rekening (khusus Pencari Kerja) =====

    public function rekeningLengkap(): bool
    {
        return filled($this->nama_bank)
            && filled($this->nomor_rekening)
            && filled($this->nama_pemilik_rekening);
    }

    public function lowongan(): \Illuminate\Database\Eloquent\Relations\HasMany
    {
        return $this->hasMany(Lowongan::class, 'id_pemberi_kerja');
    }

    public function lowonganTersimpan(): \Illuminate\Database\Eloquent\Relations\HasMany
    {
        return $this->hasMany(LowonganTersimpan::class, 'id_pencari_kerja');
    }
}
