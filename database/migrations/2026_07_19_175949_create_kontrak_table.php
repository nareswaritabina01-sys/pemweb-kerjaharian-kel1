<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('kontrak', function (Blueprint $table) {
            $table->id();

            // 1 lamaran diterima -> 1 kontrak. unique supaya tidak dobel dibuat.
            $table->foreignId('id_lamaran')->unique()->constrained('lamaran')->onDelete('cascade');

            // berlangsung: kerja sedang jalan
            // selesai: pencari kerja tandai pekerjaan selesai
            // dibayar: kedua pihak sudah konfirmasi pembayaran manual
            // sengketa: ada perselisihan, perlu ditinjau admin
            $table->enum('status', ['berlangsung', 'selesai', 'dibayar', 'sengketa'])->default('berlangsung');

            // Bukti transfer manual, diunggah oleh pemberi_kerja
            $table->string('bukti_transfer')->nullable();

            // Konfirmasi 2 arah, menggantikan fungsi escrow/Rekber
            $table->boolean('dikonfirmasi_pencari_kerja')->default(false);
            $table->boolean('dikonfirmasi_pemberi_kerja')->default(false);

            $table->timestamp('selesai_pada')->nullable();
            $table->timestamp('dibayar_pada')->nullable();

            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('kontrak');
    }
};