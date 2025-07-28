<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Penyewaan extends Model
{
    protected $fillable = [
        'mobil_id',
        'pelanggan_id',
        'tanggal_sewa',
        'tanggal_kembali',
        'tanggal_kembali_aktual',
        'total_biaya',
        'denda',
        'status',
    ];

    public function mobil()
    {
        return $this->belongsTo(Mobil::class);
    }

    public function pelanggan()
    {
        return $this->belongsTo(Pelanggan::class);
    }
}
