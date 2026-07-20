<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('lowongan', function (Blueprint $table) {
            $table->id();

            // Pemilik lowongan = user dengan role pemberi_kerja
            $table->foreignId('id_pemberi_kerja')->constrained('users')->onDelete('cascade');

            $table->string('judul');
            $table->string('nama_perusahaan')->nullable(); // nullable: bisa perorangan (Pak Budi), bukan cuma PT
            $table->string('lokasi'); // alamat teks, untuk ditampilkan
            $table->decimal('latitude', 10, 7);
            $table->decimal('longitude', 10, 7);

            $table->decimal('upah', 15, 2);
            $table->enum('satuan_upah', ['harian', 'borongan'])->default('harian');
            $table->string('kategori');
            $table->text('deskripsi');

            $table->unsignedInteger('kuota_pekerja')->default(1);
            $table->enum('status', ['dibuka', 'ditutup'])->default('dibuka');

            $table->timestamps();

            $table->index('kategori');
            $table->index(['latitude', 'longitude']);
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('lowongan');
    }
};