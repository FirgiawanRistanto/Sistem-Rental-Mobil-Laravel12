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

    public static function rules($id = null)
    {
        return [
            'merk' => 'required|string|max:255',
            'tipe' => 'required|string|max:255',
            'nopol' => 'required|string|max:255|unique:mobils,nopol,' . $id,
            'harga_sewa' => 'required|integer|min:0',
            'denda_per_hari' => 'required|integer|min:0',
            'status' => 'required|in:Tersedia,Disewa',
        ];
    }

    public static function messages()
    {
        return [
            'merk.required' => 'Merk mobil wajib diisi.',
            'merk.string' => 'Merk mobil harus berupa teks.',
            'merk.max' => 'Merk mobil tidak boleh lebih dari 255 karakter.',
            'tipe.required' => 'Tipe mobil wajib diisi.',
            'tipe.string' => 'Tipe mobil harus berupa teks.',
            'tipe.max' => 'Tipe mobil tidak boleh lebih dari 255 karakter.',
            'nopol.required' => 'Nomor polisi wajib diisi.',
            'nopol.string' => 'Nomor polisi harus berupa teks.',
            'nopol.max' => 'Nomor polisi tidak boleh lebih dari 255 karakter.',
            'nopol.unique' => 'Nomor polisi sudah terdaftar.',
            'harga_sewa.required' => 'Harga sewa wajib diisi.',
            'harga_sewa.integer' => 'Harga sewa harus berupa angka.',
            'harga_sewa.min' => 'Harga sewa tidak boleh kurang dari 0.',
            'denda_per_hari.required' => 'Denda per hari wajib diisi.',
            'denda_per_hari.integer' => 'Denda per hari harus berupa angka.',
            'denda_per_hari.min' => 'Denda per hari tidak boleh kurang dari 0.',
            'status.required' => 'Status mobil wajib diisi.',
            'status.in' => 'Status mobil tidak valid.',
        ];
    }

    public function penyewaans()
    {
        return $this->hasMany(Penyewaan::class);
    }
}
