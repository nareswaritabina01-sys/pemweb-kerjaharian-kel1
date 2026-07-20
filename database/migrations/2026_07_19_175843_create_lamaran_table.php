<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('lamaran', function (Blueprint $table) {
            $table->id();
            $table->foreignId('id_pencari_kerja')->constrained('users')->onDelete('cascade');
            $table->foreignId('id_lowongan')->constrained('lowongan')->onDelete('cascade');

            $table->enum('status', ['menunggu', 'diterima', 'ditolak'])->default('menunggu');
            $table->text('pesan')->nullable(); // pesan singkat dari pelamar saat apply

            $table->timestamps();

            // Cegah pencari kerja melamar 2x ke lowongan yang sama
            $table->unique(['id_pencari_kerja', 'id_lowongan']);
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('lamaran');
    }
};