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
        Schema::create('kategori_sampahs', function (Blueprint $table) {
            $table->id();
            $table->string('nama_kategori'); // cth: Plastik, Kertas, Besi
            $table->integer('harga_per_kg'); // cth: 2000
            $table->string('satuan')->default('Kg'); // default-nya satuan kilogram
            $table->timestamps();
        });
    }
    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('kategori_sampahs');
    }
};
