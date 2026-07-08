<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('applications', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained()->onDelete('cascade'); // freelancer pelamar
            $table->foreignId('vacancy_id')->constrained()->onDelete('cascade');
            $table->enum('status', ['pending', 'accepted', 'rejected'])->default('pending');
            $table->text('notes')->nullable();
            $table->timestamps();

            // Cegah freelancer melamar 2x ke lowongan yang sama
            $table->unique(['user_id', 'vacancy_id']);
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('applications');
    }
};