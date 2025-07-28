<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Mobil extends Model
{
    protected $fillable = [
        'merk',
        'tipe',
        'nopol',
        'harga_sewa',
        'status',
        'denda_per_hari',
    ];

    public function penyewaans()
    {
        return $this->hasMany(Penyewaan::class);
    }
}
