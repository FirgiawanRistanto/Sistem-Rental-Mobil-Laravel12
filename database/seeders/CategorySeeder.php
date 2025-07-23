<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Category;
use Illuminate\Support\Str;

class CategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $categories = [
            ['name' => 'Elektronik', 'slug' => Str::slug('Elektronik')],
            ['name' => 'Fashion Pria', 'slug' => Str::slug('Fashion Pria')],
            ['name' => 'Fashion Wanita', 'slug' => Str::slug('Fashion Wanita')],
            ['name' => 'Rumah Tangga', 'slug' => Str::slug('Rumah Tangga')],
            ['name' => 'Olahraga', 'slug' => Str::slug('Olahraga')],
            ['name' => 'Otomotif', 'slug' => Str::slug('Otomotif')],
            ['name' => 'Kesehatan & Kecantikan', 'slug' => Str::slug('Kesehatan & Kecantikan')],
            ['name' => 'Buku', 'slug' => Str::slug('Buku')],
        ];

        foreach ($categories as $category) {
            Category::create($category);
        }
    }
}