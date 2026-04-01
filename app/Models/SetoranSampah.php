<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SetoranSampah extends Model
{
    use HasFactory;

    protected $fillable = [
        'nasabah_id',
        'unit_id',
        'kategori_id',
        'berat',
        'total_harga',
        'tanggal_setor',
    ];

    // Relasi ke siapa yang menabung
    public function nasabah()
    {
        return $this->belongsTo(Nasabah::class, 'nasabah_id');
    }

    // Relasi ke unit mana tempat menabung
    public function unit()
    {
        return $this->belongsTo(UnitBankSampah::class, 'unit_id');
    }

    // Relasi ke jenis sampah apa
    public function kategori()
    {
        return $this->belongsTo(KategoriSampah::class, 'kategori_id');
    }
}