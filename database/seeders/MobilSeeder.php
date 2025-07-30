<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class MobilSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('mobils')->insert([
            [
                'merk' => 'Toyota',
                'tipe' => 'Avanza',
                'nopol' => 'B 1234 ABC',
                'harga_sewa' => 300000,
                'denda_per_hari' => 50000,
                'status' => 'Tersedia',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'merk' => 'Daihatsu',
                'tipe' => 'Xenia',
                'nopol' => 'D 5678 DEF',
                'harga_sewa' => 300000,
                'denda_per_hari' => 50000,
                'status' => 'Tersedia',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'merk' => 'Suzuki',
                'tipe' => 'Ertiga',
                'nopol' => 'E 9101 GHI',
                'harga_sewa' => 350000,
                'denda_per_hari' => 55000,
                'status' => 'Disewa',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'merk' => 'Honda',
                'tipe' => 'Mobilio',
                'nopol' => 'F 1121 JKL',
                'harga_sewa' => 400000,
                'denda_per_hari' => 60000,
                'status' => 'Tersedia',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'merk' => 'Mitsubishi',
                'tipe' => 'Xpander',
                'nopol' => 'G 3141 MNO',
                'harga_sewa' => 450000,
                'denda_per_hari' => 65000,
                'status' => 'Tersedia',
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ]);
    }
}