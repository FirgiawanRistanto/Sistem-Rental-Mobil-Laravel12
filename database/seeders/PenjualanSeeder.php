<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

class PenjualanSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('penjualan')->insert([
            [
                'nama_produk' => 'Laptop Gaming',
                'jumlah' => 1,
                'harga' => 15000000.00,
                'total' => 15000000.00,
                'tanggal_penjualan' => Carbon::now()->subDays(5),
                'nama_pelanggan' => 'Budi Santoso',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
            [
                'nama_produk' => 'Smartphone Terbaru',
                'jumlah' => 2,
                'harga' => 7500000.00,
                'total' => 15000000.00,
                'tanggal_penjualan' => Carbon::now()->subDays(3),
                'nama_pelanggan' => 'Siti Aminah',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
            [
                'nama_produk' => 'Headphone Bluetooth',
                'jumlah' => 1,
                'harga' => 1200000.00,
                'total' => 1200000.00,
                'tanggal_penjualan' => Carbon::now()->subDays(1),
                'nama_pelanggan' => 'Joko Susilo',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
        ]);
    }
}