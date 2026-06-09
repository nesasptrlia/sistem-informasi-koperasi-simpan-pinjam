<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('simpanans', function (Blueprint $table) {
            $table->id();
            $table->date('tanggal'); // Tanggal [cite: 29]
            // Relasi ke Anggota (One-to-Many) [cite: 30, 47]
            $table->foreignId('anggota_id')->constrained('anggotas')->onDelete('cascade');
            $table->string('jenis_simpanan'); // Jenis Simpanan [cite: 31]
            $table->decimal('jumlah', 12, 2); // Jumlah [cite: 32]
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('simpanans');
    }
};