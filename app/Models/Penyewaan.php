<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Penyewaan extends Model
{
    use SoftDeletes;
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

    protected $casts = [
        'tanggal_sewa' => 'datetime',
        'tanggal_kembali' => 'datetime',
        'tanggal_kembali_aktual' => 'datetime',
    ];

    public static function rules($id = null)
    {
        return [
            'mobil_id' => 'required|exists:mobils,id',
            'pelanggan_id' => 'required|exists:pelanggans,id',
            'tanggal_sewa' => 'required|date',
            'tanggal_kembali' => 'required|date|after_or_equal:tanggal_sewa',
            'tanggal_kembali_aktual' => 'nullable|date|after_or_equal:tanggal_sewa',
            'total_biaya' => 'required|integer|min:0',
            'denda' => 'nullable|integer|min:0',
            'status' => 'required|in:Disewa,Selesai',
        ];
    }

    public static function messages()
    {
        return [
            'mobil_id.required' => 'Mobil wajib dipilih.',
            'mobil_id.exists' => 'Mobil tidak ditemukan.',
            'pelanggan_id.required' => 'Pelanggan wajib dipilih.',
            'pelanggan_id.exists' => 'Pelanggan tidak ditemukan.',
            'tanggal_sewa.required' => 'Tanggal sewa wajib diisi.',
            'tanggal_sewa.date' => 'Tanggal sewa harus berupa tanggal yang valid.',
            'tanggal_kembali.required' => 'Tanggal kembali wajib diisi.',
            'tanggal_kembali.date' => 'Tanggal kembali harus berupa tanggal yang valid.',
            'tanggal_kembali.after_or_equal' => 'Tanggal kembali harus setelah atau sama dengan tanggal sewa.',
            'tanggal_kembali_aktual.date' => 'Tanggal kembali aktual harus berupa tanggal yang valid.',
            'tanggal_kembali_aktual.after_or_equal' => 'Tanggal kembali aktual harus setelah atau sama dengan tanggal sewa.',
            'total_biaya.required' => 'Total biaya wajib diisi.',
            'total_biaya.integer' => 'Total biaya harus berupa angka.',
            'total_biaya.min' => 'Total biaya tidak boleh kurang dari 0.',
            'denda.integer' => 'Denda harus berupa angka.',
            'denda.min' => 'Denda tidak boleh kurang dari 0.',
            'status.required' => 'Status penyewaan wajib diisi.',
            'status.in' => 'Status penyewaan tidak valid.',
        ];
    }

    public function mobil()
    {
        return $this->belongsTo(Mobil::class);
    }

    public function pelanggan()
    {
        return $this->belongsTo(Pelanggan::class);
    }
}
