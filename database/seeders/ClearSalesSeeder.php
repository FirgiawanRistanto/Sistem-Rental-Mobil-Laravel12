<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ClearSalesSeeder extends Seeder
{
    public function run(): void
    {
        DB::table('sales')->truncate();
    }
}
