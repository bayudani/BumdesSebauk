<?php

namespace App\Livewire\Product;

use App\Models\Product as ProductModel; // kasih alias biar ga tabrakan

use Livewire\Component;

class Product extends Component
{
    public function goToCheckout($id)
    {
        return redirect()->route('checkout', ['id' => $id]);
    }

   public function render()
{
    $products = ProductModel::with('category')
        ->orderBy('created_at', 'desc') // produk terbaru duluan
        ->get();

    // Group by nama kategori
    $grouped = $products->groupBy(function ($item) {
        return $item->category->name ?? 'Tanpa Kategori';
    });

    $priority = ['Tenun', 'Makanan', 'Alat']; // harus sama persis dengan nama kategori di DB

$sorted = collect();

// Masukin kategori prioritas dulu
foreach ($priority as $cat) {
    // Bandingin tanpa case sensitive
    $match = $grouped->first(function ($_, $key) use ($cat) {
        return strtolower($key) === strtolower($cat);
    });

    if ($match) {
        // Cari key aslinya
        $realKey = $grouped->keys()->first(function ($key) use ($cat) {
            return strtolower($key) === strtolower($cat);
        });

        $sorted[$realKey] = $grouped[$realKey];
        $grouped->forget($realKey);
    }
}

// Sisanya masuk sesuai urutan alphabet
foreach ($grouped->sortKeys() as $cat => $items) {
    $sorted[$cat] = $items;
}
    return view('livewire.product.product', [
        'categories' => $sorted
    ]);
}

}
