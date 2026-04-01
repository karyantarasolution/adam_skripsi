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
        Schema::create('setoran_sampahs', function (Blueprint $table) {
            $table->id();
            $table->foreignId('nasabah_id')->constrained('nasabahs')->onDelete('cascade');
            $table->foreignId('unit_id')->constrained('unit_bank_sampahs')->onDelete('cascade');
            $table->foreignId('kategori_id')->constrained('kategori_sampahs')->onDelete('cascade');
            
            $table->float('berat'); // Menggunakan float karena berat bisa desimal, misal 1.5 kg
            $table->integer('total_harga');
            $table->date('tanggal_setor');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('setoran_sampahs');
    }
};
