<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PenarikanSaldo extends Model
{
    use HasFactory;

    protected $fillable = [
        'nasabah_id',
        'unit_id',
        'jumlah_tarik',
        'tanggal_tarik',
        'status',
    ];

    public function nasabah()
    {
        return $this->belongsTo(Nasabah::class, 'nasabah_id');
    }

    public function unit()
    {
        return $this->belongsTo(UnitBankSampah::class, 'unit_id');
    }
}