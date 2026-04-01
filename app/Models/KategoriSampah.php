<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class KategoriSampah extends Model
{
    use HasFactory;

    // Tambahkan baris ini agar data bisa disimpan
    protected $fillable = [
        'nama_kategori',
        'harga_per_kg',
        'satuan',
    ];
}