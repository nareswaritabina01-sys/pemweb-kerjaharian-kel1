<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Kontrak extends Model
{
    protected $table = 'kontrak';

    protected $fillable = [
        'id_lamaran',
        'status',
        'bukti_transfer',
        'dikonfirmasi_pencari_kerja',
        'dikonfirmasi_pemberi_kerja',
        'selesai_pada',
        'dibayar_pada',
    ];

    protected function casts(): array
    {
        return [
            'dikonfirmasi_pencari_kerja' => 'boolean',
            'dikonfirmasi_pemberi_kerja' => 'boolean',
            'selesai_pada' => 'datetime',
            'dibayar_pada' => 'datetime',
        ];
    }

    // ===== Relasi =====

    public function lamaran(): BelongsTo
    {
        return $this->belongsTo(Lamaran::class, 'id_lamaran');
    }

    // ===== Scope =====

    public function scopeBerlangsung(Builder $query): Builder
    {
        return $query->where('status', 'berlangsung');
    }

    public function scopeSelesai(Builder $query): Builder
    {
        return $query->where('status', 'selesai');
    }

    public function scopeDibayar(Builder $query): Builder
    {
        return $query->where('status', 'dibayar');
    }

    // ===== Accessor =====

    public function getBuktiTransferUrlAttribute(): ?string
    {
        return $this->bukti_transfer
            ? asset('storage/' . $this->bukti_transfer)
            : null;
    }
}