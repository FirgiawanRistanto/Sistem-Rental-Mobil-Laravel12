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

    public static function rules($id = null)
    {
        return [
            'nama' => 'required|string|max:255',
            'no_ktp' => 'required|string|max:16|unique:pelanggans,no_ktp,' . $id,
            'no_hp' => 'required|string|max:13',
            'alamat' => 'required|string',
        ];
    }

    public static function messages()
    {
        return [
            'nama.required' => 'Nama pelanggan wajib diisi.',
            'nama.string' => 'Nama pelanggan harus berupa teks.',
            'nama.max' => 'Nama pelanggan tidak boleh lebih dari 255 karakter.',
            'no_ktp.required' => 'Nomor KTP/SIM wajib diisi.',
            'no_ktp.string' => 'Nomor KTP/SIM harus berupa teks.',
            'no_ktp.max' => 'Nomor KTP/SIM tidak boleh lebih dari 16 karakter.',
            'no_ktp.unique' => 'Nomor KTP/SIM sudah terdaftar.',
            'no_hp.required' => 'Nomor HP wajib diisi.',
            'no_hp.string' => 'Nomor HP harus berupa teks.',
            'no_hp.max' => 'Nomor HP tidak boleh lebih dari 13 karakter.',
            'alamat.required' => 'Alamat wajib diisi.',
            'alamat.string' => 'Alamat harus berupa teks.',
        ];
    }

    public function penyewaans()
    {
        return $this->hasMany(Penyewaan::class);
    }
}
