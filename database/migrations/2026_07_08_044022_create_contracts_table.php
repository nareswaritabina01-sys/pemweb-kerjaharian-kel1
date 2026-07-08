<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('contracts', function (Blueprint $table) {
            $table->id();

            // Satu application yang diterima -> jadi satu contract
            $table->foreignId('application_id')->constrained()->onDelete('cascade');

            // ongoing: kerja berjalan
            // completed: freelancer tandai kerja selesai
            // paid: client tandai sudah transfer manual
            // disputed: ada sengketa, butuh admin
            $table->enum('status', ['ongoing', 'completed', 'paid', 'disputed'])->default('ongoing');

            // Konfirmasi dua arah menggantikan fungsi "jaminan" Rekber
            $table->boolean('confirmed_by_freelancer')->default(false); // freelancer konfirmasi terima uang
            $table->boolean('confirmed_by_client')->default(false);     // client konfirmasi sudah transfer

            $table->timestamp('completed_at')->nullable();
            $table->timestamp('paid_at')->nullable();

            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('contracts');
    }
};