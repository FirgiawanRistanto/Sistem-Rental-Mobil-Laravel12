<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

class SalesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Clear existing sales data
        DB::table('sales')->truncate();

        // Seed the sales table with sample data
        DB::table('sales')->insert([
            [
                'product_name' => 'Laptop',
                'quantity' => 2,
                'price' => 1500.00,
                'total' => 3000.00,
                'sale_date' => Carbon::now()->subDays(10),
                'customer_name' => 'John Doe',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
            [
                'product_name' => 'Smartphone',
                'quantity' => 5,
                'price' => 800.00,
                'total' => 4000.00,
                'sale_date' => Carbon::now()->subDays(5),
                'customer_name' => 'Jane Smith',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
            [
                'product_name' => 'Tablet',
                'quantity' => 3,
                'price' => 600.00,
                'total' => 1800.00,
                'sale_date' => Carbon::now()->subDays(2),
                'customer_name' => 'Jhon Jones',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
        ]);
    }
}
