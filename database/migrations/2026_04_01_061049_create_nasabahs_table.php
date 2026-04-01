<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
public function up(): void
    {
        Schema::create('nasabahs', function (Blueprint $table) {
            $table->id();
            // Relasi ke tabel users (Akun login si Nasabah)
            $table->foreignId('user_id')->constrained('users')->onDelete('cascade');
            // Relasi ke tabel unit bank sampah (Warga ini nabung di unit mana)
            $table->foreignId('unit_id')->constrained('unit_bank_sampahs')->onDelete('cascade');
            
            $table->string('nik', 16)->unique();
            $table->text('alamat');
            $table->string('no_telp', 15);
            $table->timestamps();
        });
    }
    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('nasabahs');
    }
};
