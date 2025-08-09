<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Product;
use App\Models\Category;

class ProductSeeder extends Seeder
{
    public function run(): void
    {
        $categories = Category::all()->keyBy('name'); // supaya bisa akses via nama

        $products = [
            [
                'name' => 'Palu Besi',
                'description' => 'Palu untuk pertukangan berat',
                'price' => 75000,
                // 'image' => 'palu.jpg',
                'category_id' => $categories['alat']->id ?? null,
                'stok' => 20,
            ],
            [
                'name' => 'Kain Tenun Bali',
                'description' => 'Kain tenun asli dari Bali dengan motif tradisional',
                'price' => 150000,
                // 'image' => 'tenun_bali.jpg',
                'category_id' => $categories['tenun']->id ?? null,
                'stok' => 10,
            ],
            [
                'name' => 'Keripik Singkong Pedas',
                'description' => 'Cemilan pedas khas rumahan',
                'price' => 25000,
                // 'image' => 'keripik.jpg',
                'category_id' => $categories['makanan']->id ?? null,
                'stok' => 50,
            ],
        ];

        foreach ($products as $data) {
            if ($data['category_id']) {
                Product::create($data);
            }
        }
    }
}
