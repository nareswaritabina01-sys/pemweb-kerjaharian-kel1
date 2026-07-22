<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('users', function (Blueprint $table) {
            $table->dropColumn('status_aktif');
        });

        Schema::table('users', function (Blueprint $table) {
            $table->enum('status_akun', ['aktif', 'nonaktif', 'banned'])
                ->default('aktif')
                ->after('nama_pemilik_rekening');
        });
    }

    public function down(): void
    {
        Schema::table('users', function (Blueprint $table) {
            $table->dropColumn('status_akun');
        });

        Schema::table('users', function (Blueprint $table) {
            $table->boolean('status_aktif')->default(true);
        });
    }
};
