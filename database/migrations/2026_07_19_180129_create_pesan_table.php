<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('pesan', function (Blueprint $table) {
            $table->id();
            $table->foreignId('id_percakapan')->constrained('percakapan')->onDelete('cascade');
            $table->foreignId('id_pengirim')->constrained('users')->onDelete('cascade');

            $table->text('isi');
            $table->timestamp('dibaca_pada')->nullable();

            $table->timestamps();

            $table->index('id_percakapan');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('pesan');
    }
};