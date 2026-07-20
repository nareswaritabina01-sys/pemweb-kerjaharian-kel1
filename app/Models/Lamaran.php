<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasOne;

class Lamaran extends Model
{
    protected $table = 'lamaran';

    protected $fillable = [
        'id_pencari_kerja',
        'id_lowongan',
        'status',
        'pesan',
    ];

    // ===== Relasi =====

    public function pencariKerja(): BelongsTo
    {
        return $this->belongsTo(User::class, 'id_pencari_kerja');
    }

    public function lowongan(): BelongsTo
    {
        return $this->belongsTo(Lowongan::class, 'id_lowongan');
    }

    public function kontrak(): HasOne
    {
        return $this->hasOne(Kontrak::class, 'id_lamaran');
    }

    public function percakapan(): HasOne
    {
        return $this->hasOne(Percakapan::class, 'id_lamaran');
    }

    // ===== Scope =====

    public function scopeMenunggu(Builder $query): Builder
    {
        return $query->where('status', 'menunggu');
    }

    public function scopeDiterima(Builder $query): Builder
    {
        return $query->where('status', 'diterima');
    }

    public function scopeDitolak(Builder $query): Builder
    {
        return $query->where('status', 'ditolak');
    }
}