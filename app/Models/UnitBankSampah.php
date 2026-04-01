<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class UnitBankSampah extends Model
{
    use HasFactory;

    protected $fillable = [
        'nama_unit',
        'alamat',
        'admin_id',
    ];

    // Relasi ke tabel users (Satu unit dipegang oleh satu admin)
    public function admin()
    {
        return $this->belongsTo(User::class, 'admin_id');
    }
}