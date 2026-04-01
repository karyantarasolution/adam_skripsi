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
        Schema::create('unit_bank_sampahs', function (Blueprint $table) {
            $table->id();
            $table->string('nama_unit'); // cth: Bank Sampah Kenanga RT 05
            $table->text('alamat');
            // Relasi ke tabel users (Siapa Admin Unit yang pegang tempat ini)
            $table->foreignId('admin_id')->constrained('users')->onDelete('cascade');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('unit_bank_sampahs');
    }
};
