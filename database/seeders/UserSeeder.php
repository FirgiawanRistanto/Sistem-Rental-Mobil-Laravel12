<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Clear existing users data
        DB::table('users')->truncate();
        // Seed the users table with sample data
        DB::table('users')->insert([
            [
                'name' => 'Superadmin',
                'email' => 'superadmin@gmail.com',
                'email_verified_at' => now(),
                'password' => bcrypt('12345678'),
                'remember_token' => Str::random(10),
                'jenis_kelamin' => 'Perempuan',
                'foto' => 'superadmin.jpg',
                'alamat' => 'Jl. Pagangsaan Timur No. 56, Jakarta',
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ]);
    }
}
