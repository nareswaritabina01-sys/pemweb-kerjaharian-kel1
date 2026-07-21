<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('percakapan', function (Blueprint $table) {
            $table->id();

            // 1 lamaran -> maksimal 1 percakapan
            $table->foreignId('id_lamaran')->unique()->constrained('lamaran')->onDelete('cascade');

            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('percakapan');
    }
};