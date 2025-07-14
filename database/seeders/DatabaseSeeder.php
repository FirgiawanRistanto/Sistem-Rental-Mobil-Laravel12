<?php

namespace Database\Seeders;

use App\Models\User;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // \App\Models\User::factory(10)->create();

        // Seed the users table
        // This will clear the users table and insert new sample data
        $this->call(UserSeeder::class);
        // Clear existing sales data
        $this->call(ClearSalesSeeder::class);
        // Seed the sales table
        $this->call(SalesSeeder::class);
        
    }
}
