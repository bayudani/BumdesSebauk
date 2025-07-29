<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Category;

class CategorySeeder extends Seeder
{
    public function run(): void
    {
        $categories = [
            [
                'name' => 'alat',
                'description' => 'Kategori untuk peralatan',
            ],
            [
                'name' => 'tenun',
                'description' => 'Kategori untuk produk tenun',
            ],
            [
                'name' => 'makanan',
                'description' => 'Kategori untuk makanan khas',
            ],
        ];

        foreach ($categories as $data) {
            Category::create($data);
        }
    }
}
