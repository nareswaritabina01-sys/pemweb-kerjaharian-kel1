<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        // Seed kategori dulu di dalam migration ini, supaya urutan eksekusi terjamin
        $daftarKategori = [
            'Pertukangan',
            'ART',
            'Buruh Harian',
            'Supir',
            'Security',
            'Tukang Kebun',
            'Laundry',
            'Lainnya',
        ];

        foreach ($daftarKategori as $nama) {
            DB::table('kategori')->insertOrIgnore([
                'nama' => $nama,
                'created_at' => now(),
                'updated_at' => now(),
            ]);
        }

        // Backfill kategori_id berdasarkan mapping nama kategori (string) lama
        $kategoriList = DB::table('kategori')->pluck('id', 'nama');

        foreach ($kategoriList as $nama => $id) {
            DB::table('lowongan')
                ->where('kategori', $nama)
                ->update(['kategori_id' => $id]);
        }

        // Fallback: lowongan dengan kategori tidak dikenali (data kotor) -> "Lainnya"
        $idLainnya = DB::table('kategori')->where('nama', 'Lainnya')->value('id');
        if ($idLainnya) {
            DB::table('lowongan')->whereNull('kategori_id')->update(['kategori_id' => $idLainnya]);
        }

        // Baru wajibkan kategori_id (NOT NULL) dan drop kolom lama
        Schema::table('lowongan', function (Blueprint $table) {
            $table->foreignId('kategori_id')->nullable(false)->change();
            $table->dropColumn('kategori');
        });
    }

    public function down(): void
    {
        Schema::table('lowongan', function (Blueprint $table) {
            $table->string('kategori')->nullable()->after('kategori_id');
            $table->foreignId('kategori_id')->nullable()->change();
        });
    }
};
