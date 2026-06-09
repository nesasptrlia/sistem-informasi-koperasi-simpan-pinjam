<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('anggotas', function (Blueprint $table) {
            $table->id(); // ID Anggota [cite: 24]
            $table->string('nama'); // Nama [cite: 25]
            $table->text('alamat'); // Alamat [cite: 26]
            $table->string('no_telepon'); // No. Telepon [cite: 27]
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('anggotas');
    }
};