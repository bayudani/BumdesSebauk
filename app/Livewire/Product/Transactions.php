<?php

namespace App\Livewire\Product;

use Livewire\Attributes\Layout;
use Livewire\Component;
use App\Models\Product as ProductModel;
use App\Models\Transaction; // <-- IMPORT MODEL TRANSACTION
use Livewire\WithFileUploads; // <-- IMPORT UNTUK FILE UPLOAD

#[Layout('layouts.app')]
class Transactions extends Component
{
    // Gunakan trait ini untuk handle upload file
    use WithFileUploads;

    // Properti untuk menampung data produk
    public ProductModel $product;

    // Properti untuk menampung input dari form
    public $quantity = 1; // Default kuantitas 1
    public $customer_name = '';
    public $customer_address = '';
    public $customer_phone = '';
    public $payment_method = 'Bank BCA'; // Default pilihan bank
    public $proof_of_transaction; // Untuk menampung file upload

    // Method mount tetap sama, hanya untuk mengambil data produk awal
    public function mount($id)
    {
        $this->product = ProductModel::findOrFail($id);
    }

    // Method untuk menyimpan transaksi
    public function save()
    {
        // Validasi input
        $this->validate([
            'customer_name' => 'required|string|max:255',
            'customer_address' => 'required|string',
            'customer_phone' => 'required|string|max:20',
            'quantity' => 'required|integer|min:1',
            'payment_method' => 'required|string',
            'proof_of_transaction' => 'required|image|max:2048', // Max 2MB
        ]);

        // Hitung total amount berdasarkan kuantitas terakhir
        $totalAmount = $this->product->price * $this->quantity;
        // Kamu bisa tambahkan pajak atau biaya lain di sini jika perlu
        // $totalAmount += ($totalAmount * 0.11); 

        // Simpan file bukti transfer
        $path = $this->proof_of_transaction->store('proofs', 'public');

        // Buat transaksi baru
        Transaction::create([
            'product_id' => $this->product->id,
            'customer_name' => $this->customer_name,
            'customer_address' => $this->customer_address,
            'customer_phone' => $this->customer_phone,
            'quantity' => $this->quantity,
            'total_amount' => $totalAmount,
            'status' => 'pending', // Status awal saat transaksi dibuat
            'transaction_date' => now(),
            'payment_method' => $this->payment_method,
            'proof_of_transaction' => $path,
        ]);

        // Beri pesan sukses dan redirect ke halaman lain
        session()->flash('message', 'Transaksi berhasil dibuat dan sedang diproses.');
        return redirect()->to('/produk'); // Atau ke halaman "terima kasih"
    }

    public function render()
    {
        // Kalkulasi ditaruh di render agar dinamis saat kuantitas berubah
        $subtotal = $this->product->price * $this->quantity;
        $tax = $subtotal * 0.11; // Pajak 11% dari subtotal
        $totalPrice = $subtotal + $tax;

        return view('livewire.product.transactions', [
            'subtotal' => $subtotal,
            'tax' => $tax,
            'totalPrice' => $totalPrice,
        ]);
    }
}
