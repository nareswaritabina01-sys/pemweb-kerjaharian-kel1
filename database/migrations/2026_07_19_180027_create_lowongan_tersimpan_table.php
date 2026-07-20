<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('lowongan_tersimpan', function (Blueprint $table) {
            $table->id();
            $table->foreignId('id_pencari_kerja')->constrained('users')->onDelete('cascade');
            $table->foreignId('id_lowongan')->constrained('lowongan')->onDelete('cascade');
            $table->timestamps();

            // Cegah simpan lowongan yang sama 2x
            $table->unique(['id_pencari_kerja', 'id_lowongan']);
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('lowongan_tersimpan');
    }
};