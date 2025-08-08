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
        $products = ProductModel::with('category')->get();
        return view('livewire.product.product', compact('products'));
    }
}
