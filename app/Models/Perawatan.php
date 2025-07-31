<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Perawatan extends Model
{
    protected $fillable = [
        'mobil_id',
        'tanggal_mulai',
        'tanggal_selesai',
        'deskripsi',
        'biaya',
        'status',
    ];

    public function mobil()
    {
        return $this->belongsTo(Mobil::class);
    }
}
