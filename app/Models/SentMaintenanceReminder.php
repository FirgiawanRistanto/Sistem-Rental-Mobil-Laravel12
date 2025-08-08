<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SentMaintenanceReminder extends Model
{
    use HasFactory;

    protected $fillable = [
        'mobil_id',
        'maintenance_date',
        'reminder_days_before',
        'sent_at',
    ];

    public function mobil()
    {
        return $this->belongsTo(Mobil::class);
    }
}
