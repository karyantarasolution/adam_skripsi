<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Nasabah extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'unit_id',
        'nik',
        'alamat',
        'no_telp',
    ];

    // Relasi ke Akun Login
    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    // Relasi ke Unit Bank Sampah tempat dia mendaftar
    public function unit()
    {
        return $this->belongsTo(UnitBankSampah::class, 'unit_id');
    }

    // Relasi ke Saldo (Satu nasabah punya satu record saldo)
    public function saldo()
    {
        return $this->hasOne(SaldoNasabah::class, 'nasabah_id');
    }
}