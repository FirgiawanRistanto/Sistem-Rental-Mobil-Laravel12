<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Perawatan extends Model
{
    use SoftDeletes;
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
