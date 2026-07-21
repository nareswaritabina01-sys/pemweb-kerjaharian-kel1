<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Percakapan extends Model
{
    protected $table = 'percakapan';

    protected $fillable = [
        'id_lamaran',
    ];

    public function lamaran(): BelongsTo
    {
        return $this->belongsTo(Lamaran::class, 'id_lamaran');
    }

    public function pesan(): HasMany
    {
        return $this->hasMany(Pesan::class, 'id_percakapan')->orderBy('id');
    }

    public function pesanTerakhir(): HasMany
    {
        return $this->pesan()->latest()->limit(1);
    }

    // Diturunkan dari relasi, bukan disimpan langsung (single source of truth)

    public function pemberiKerja(): ?User
    {
        return $this->lamaran?->lowongan?->pemberiKerja;
    }

    public function pencariKerja(): ?User
    {
        return $this->lamaran?->pencariKerja;
    }

    /**
     * Lawan bicara dari sudut pandang $user yang sedang login.
     */
    public function lawanBicara(User $user): ?User
    {
        if ($user->isPencariKerja()) {
            return $this->pemberiKerja();
        }

        return $this->pencariKerja();
    }
}