<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Pelanggan extends Model
{
    protected $fillable = [
        'nama',
        'no_ktp',
        'no_hp',
        'alamat',
    ];

    public function penyewaans()
    {
        return $this->hasMany(Penyewaan::class);
    }
}
