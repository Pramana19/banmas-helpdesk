<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Category;

class CategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Daftar kategori bantuan IT sesuai PRD kita
        $categories = [
            ['name' => 'Hardware', 'slug' => 'hardware'],
            ['name' => 'Software', 'slug' => 'software'],
            ['name' => 'Network', 'slug' => 'network'],
            ['name' => 'Printer', 'slug' => 'printer'],
            ['name' => 'Account', 'slug' => 'account'],
            ['name' => 'CCTV', 'slug' => 'cctv'],
            ['name' => 'Radio/HT', 'slug' => 'radio-ht'],
            ['name' => 'Server', 'slug' => 'server'],
            ['name' => 'Other', 'slug' => 'other'],
        ];

        foreach ($categories as $category) {
            Category::create($category);
        }
    }
}
