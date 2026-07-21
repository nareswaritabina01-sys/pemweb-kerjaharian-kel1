<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Pesan extends Model
{
    protected $table = 'pesan';

    protected $fillable = [
        'id_percakapan',
        'id_pengirim',
        'isi',
        'dibaca_pada',
    ];

    protected function casts(): array
    {
        return [
            'dibaca_pada' => 'datetime',
        ];
    }

    public function percakapan(): BelongsTo
    {
        return $this->belongsTo(Percakapan::class, 'id_percakapan');
    }

    public function pengirim(): BelongsTo
    {
        return $this->belongsTo(User::class, 'id_pengirim');
    }

    public function sudahDibaca(): bool
    {
        return $this->dibaca_pada !== null;
    }
}