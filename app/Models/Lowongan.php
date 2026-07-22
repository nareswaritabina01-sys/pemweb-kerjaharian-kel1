<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Lowongan extends Model
{
    protected $table = 'lowongan';
    protected $fillable = [
        'id_pemberi_kerja',
        'judul',
        'nama_perusahaan',
        'lokasi',
        'latitude',
        'longitude',
        'upah',
        'satuan_upah',
        'kategori_id',
        'deskripsi',
        'kuota_pekerja',
        'status',
    ];
    protected function casts(): array
    {
        return [
            'latitude' => 'decimal:7',
            'longitude' => 'decimal:7',
            'upah' => 'decimal:2',
        ];
    }
    // ===== Relasi =====
    public function pemberiKerja(): BelongsTo
    {
        return $this->belongsTo(User::class, 'id_pemberi_kerja');
    }
    public function kategori(): BelongsTo
    {
        return $this->belongsTo(Kategori::class, 'kategori_id');
    }
    public function lamaran(): HasMany
    {
        return $this->hasMany(Lamaran::class, 'id_lowongan');
    }
    public function penyimpan(): HasMany
    {
        return $this->hasMany(LowonganTersimpan::class, 'id_lowongan');
    }
    // ===== Scope =====
    public function scopeDibuka(Builder $query): Builder
    {
        return $query->where('status', 'dibuka');
    }
    public function scopeDenganKategori(Builder $query, int $kategoriId): Builder
    {
        return $query->where('kategori_id', $kategoriId);
    }
    /**
     * Radius search pakai Haversine formula.
     * Menambahkan kolom virtual `jarak` (km) & urut dari yang terdekat.
     */
    public function scopeTerdekat(Builder $query, float $lat, float $lng, ?float $radiusKm = null): Builder
    {
        $query->selectRaw(
            "lowongan.*, (6371 * acos(cos(radians(?)) * cos(radians(latitude)) * cos(radians(longitude) - radians(?)) + sin(radians(?)) * sin(radians(latitude)))) AS jarak",
            [$lat, $lng, $lat]
        )->orderBy('jarak', 'asc');
        if ($radiusKm !== null) {
            $query->having('jarak', '<=', $radiusKm);
        }
        return $query;
    }
    // ===== Accessor =====
    public function getSisaKuotaAttribute(): int
    {
        $diterima = $this->lamaran()->where('status', 'diterima')->count();
        return max(0, $this->kuota_pekerja - $diterima);
    }
}
