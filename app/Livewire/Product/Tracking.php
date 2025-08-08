<?php

namespace App\Livewire\Product;

use App\Models\Transaction;
use Livewire\Component;
use Livewire\Attributes\Layout;


#[Layout('layouts.app')]

class Tracking extends Component
{

     public ?Transaction $transaction; // Properti untuk menampung data transaksi

    /**
     * Inisialisasi komponen, mengambil data transaksi berdasarkan ID dari URL.
     */
    public function mount($id)
    {
        // Cari transaksi berdasarkan ID, dan ambil juga relasi 'product'-nya.
        // Jika tidak ketemu, akan menampilkan halaman 404.
        $this->transaction = Transaction::with('product')->findOrFail($id);
    }

    public function render()
    {
        return view('livewire.product.tracking');
    }
}
