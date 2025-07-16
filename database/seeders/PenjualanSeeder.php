<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class PenjualanSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $sales = DB::table('sales')->get();

        foreach ($sales as $sale) {
            DB::table('penjualan')->insert([
                'nama_produk' => $sale->product_name,
                'jumlah' => $sale->quantity,
                'harga' => $sale->price,
                'total' => $sale->total,
                'tanggal_penjualan' => $sale->sale_date,
                'nama_pelanggan' => $sale->customer_name,
                'created_at' => $sale->created_at,
                'updated_at' => $sale->updated_at,
            ]);
        }
    }
}