<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class LowonganTersimpan extends Model
{
    protected $table = 'lowongan_tersimpan';

    protected $fillable = [
        'id_pencari_kerja',
        'id_lowongan',
    ];

    public function pencariKerja(): BelongsTo
    {
        return $this->belongsTo(User::class, 'id_pencari_kerja');
    }

    public function lowongan(): BelongsTo
    {
        return $this->belongsTo(Lowongan::class, 'id_lowongan');
    }
}