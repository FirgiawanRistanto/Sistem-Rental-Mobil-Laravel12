<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class MobilGambar extends Model
{
    protected $fillable = ['mobil_id', 'path', 'tipe', 'label'];

    public function mobil()
    {
        return $this->belongsTo(Mobil::class);
    }
}
