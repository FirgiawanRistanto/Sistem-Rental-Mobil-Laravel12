<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class PelangganSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('pelanggans')->insert([
            [
                'nama' => 'Budi Santoso',
                'no_ktp' => '3273241234560001',
                'no_hp' => '081234567890',
                'alamat' => 'Jl. Merdeka No. 1, Bandung',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'nama' => 'Ani Suryani',
                'no_ktp' => '3273241234560002',
                'no_hp' => '081234567891',
                'alamat' => 'Jl. Asia Afrika No. 2, Bandung',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'nama' => 'Cici Paramida',
                'no_ktp' => '3273241234560003',
                'no_hp' => '081234567892',
                'alamat' => 'Jl. Braga No. 3, Bandung',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'nama' => 'Dedi Mulyadi',
                'no_ktp' => '3273241234560004',
                'no_hp' => '081234567893',
                'alamat' => 'Jl. Sudirman No. 4, Jakarta Pusat',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'nama' => 'Euis Dahlia',
                'no_ktp' => '3273241234560005',
                'no_hp' => '081234567894',
                'alamat' => 'Jl. Thamrin No. 5, Jakarta Pusat',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'nama' => 'Fajar Nugraha',
                'no_ktp' => '3273241234560006',
                'no_hp' => '081234567895',
                'alamat' => 'Jl. Gatot Subroto No. 6, Jakarta Selatan',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'nama' => 'Gita Gutawa',
                'no_ktp' => '3273241234560007',
                'no_hp' => '081234567896',
                'alamat' => 'Jl. HR Rasuna Said No. 7, Jakarta Selatan',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'nama' => 'Hendra Setiawan',
                'no_ktp' => '3273241234560008',
                'no_hp' => '081234567897',
                'alamat' => 'Jl. Tunjungan No. 8, Surabaya',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'nama' => 'Isyana Sarasvati',
                'no_ktp' => '3273241234560009',
                'no_hp' => '081234567898',
                'alamat' => 'Jl. Darmo No. 9, Surabaya',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'nama' => 'Joko Widodo',
                'no_ktp' => '3273241234560010',
                'no_hp' => '081234567899',
                'alamat' => 'Jl. Malioboro No. 10, Yogyakarta',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'nama' => 'Krisdayanti',
                'no_ktp' => '3273241234560011',
                'no_hp' => '081234567800',
                'alamat' => 'Jl. Slamet Riyadi No. 11, Surakarta',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'nama' => 'Luna Maya',
                'no_ktp' => '3273241234560012',
                'no_hp' => '081234567801',
                'alamat' => 'Jl. Gajah Mada No. 12, Semarang',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'nama' => 'Muhammad Ali',
                'no_ktp' => '3273241234560013',
                'no_hp' => '081234567802',
                'alamat' => 'Jl. Pemuda No. 13, Semarang',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'nama' => 'Najwa Shihab',
                'no_ktp' => '3273241234560014',
                'no_hp' => '081234567803',
                'alamat' => 'Jl. Pandanaran No. 14, Semarang',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'nama' => 'Opick',
                'no_ktp' => '3273241234560015',
                'no_hp' => '081234567804',
                'alamat' => 'Jl. Pahlawan No. 15, Semarang',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'nama' => 'Pasha Ungu',
                'no_ktp' => '3273241234560016',
                'no_hp' => '081234567805',
                'alamat' => 'Jl. Ahmad Yani No. 16, Medan',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'nama' => 'Qibil The Changcuters',
                'no_ktp' => '3273241234560017',
                'no_hp' => '081234567806',
                'alamat' => 'Jl. Sisingamangaraja No. 17, Medan',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'nama' => 'Raisa Andriana',
                'no_ktp' => '3273241234560018',
                'no_hp' => '081234567807',
                'alamat' => 'Jl. Gatot Subroto No. 18, Medan',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'nama' => 'Sule Sutisna',
                'no_ktp' => '3273241234560019',
                'no_hp' => '081234567808',
                'alamat' => 'Jl. Imam Bonjol No. 19, Denpasar',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'nama' => 'Tulus',
                'no_ktp' => '3273241234560020',
                'no_hp' => '081234567809',
                'alamat' => 'Jl. Teuku Umar No. 20, Denpasar',
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ]);
    }
}
