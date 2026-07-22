<?php
// database/migrations/2026_07_22_100001_add_kategori_id_to_lowongan_table.php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('lowongan', function (Blueprint $table) {
            $table->foreignId('kategori_id')
                ->nullable()
                ->after('kategori')
                ->constrained('kategori')
                ->onDelete('restrict');
        });
    }

    public function down(): void
    {
        Schema::table('lowongan', function (Blueprint $table) {
            $table->dropForeign(['kategori_id']);
            $table->dropColumn('kategori_id');
        });
    }
};
