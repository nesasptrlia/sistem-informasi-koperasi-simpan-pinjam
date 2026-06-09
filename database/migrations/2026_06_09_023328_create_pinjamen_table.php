<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('pinjamans', function (Blueprint $table) {
            $table->id();
            $table->date('tanggal_pinjaman'); // Tanggal Pinjaman [cite: 34]
            // Relasi ke Anggota [cite: 35, 47]
            $table->foreignId('anggota_id')->constrained('anggotas')->onDelete('cascade');
            $table->decimal('jumlah_pinjaman', 12, 2); // Jumlah Pinjaman [cite: 36]
            $table->integer('lama_angsuran'); // Lama Angsuran [cite: 37]
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('pinjamans');
    }
};