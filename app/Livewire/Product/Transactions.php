<?php

namespace App\Livewire\Product;

use Livewire\Attributes\Layout;
use Livewire\Component;
use App\Models\Product as ProductModel;
use App\Models\Transaction;
use Livewire\WithFileUploads;
use Illuminate\Support\Facades\DB;
use Illuminate\Validation\ValidationException;

#[Layout('layouts.app')]
class Transactions extends Component
{
    // Gunakan trait ini untuk handle upload file
    use WithFileUploads;

    // Properti untuk menampung data produk
    public ProductModel $product;

    // Properti untuk menampung input dari form
    public $quantity = 1;
    public $customer_name = '';
    public $customer_address = '';
    public $customer_phone = '';
    public $payment_method = 'Bank BCA'; // Default pilihan bank
    public $proof_of_transaction;

    /**
     * Inisialisasi komponen dengan data produk berdasarkan ID dari URL.
     */
    public function mount($id)
    {
        $this->product = ProductModel::findOrFail($id);
    }

    /**
     * Method untuk menambah kuantitas, dengan batasan stok.
     */
    public function incrementQuantity()
    {
        if ($this->quantity < $this->product->stok) {
            $this->quantity++;
        }
    }

    /**
     * Method untuk mengurangi kuantitas, dengan batasan minimal 1.
     */
    public function decrementQuantity()
    {
        if ($this->quantity > 1) {
            $this->quantity--;
        }
    }

    /**
     * Method utama untuk menyimpan transaksi ke database.
     */
    public function save()
    {
        // Validasi semua input dari form
        $this->validate([
            'customer_name' => 'required|string|max:255',
            'customer_address' => 'required|string',
            'customer_phone' => 'required|string|max:20',
            'quantity' => 'required|integer|min:1',
            'payment_method' => 'required|string',
            'proof_of_transaction' => 'required|image|max:2048', // Max 2MB
        ]);

        // Validasi ketersediaan stok sebelum melanjutkan
        if ($this->product->stok < $this->quantity) {
            throw ValidationException::withMessages([
                'quantity' => 'Maaf, stok tidak mencukupi. Sisa stok: ' . $this->product->stok,
            ]);
            return;
        }

        try {
            // Gunakan Database Transaction untuk memastikan semua proses berhasil atau semua dibatalkan.
            // Ini mencegah stok berkurang jika ada error saat menyimpan data transaksi.
            DB::transaction(function () {
                // Hitung total harga (tanpa pajak, karena pajak hanya untuk tampilan)
                $totalAmount = $this->product->price * $this->quantity;

                // Simpan file bukti transfer ke storage/app/public/proofs
                $path = $this->proof_of_transaction->store('proofs', 'public');

                // Buat record transaksi baru di database
                Transaction::create([
                    'product_id' => $this->product->id,
                    'customer_name' => $this->customer_name,
                    'customer_address' => $this->customer_address,
                    'customer_phone' => $this->customer_phone,
                    'quantity' => $this->quantity,
                    'total_amount' => $totalAmount,
                    'status' => 'pending', // Status awal
                    'transaction_date' => now(),
                    'payment_method' => $this->payment_method,
                    'proof_of_transaction' => $path,
                ]);

                // Kurangi stok produk setelah transaksi berhasil dibuat
                $this->product->decrement('stok', $this->quantity);
            });

            // Set pesan sukses dan redirect
            session()->flash('message', 'Transaksi berhasil dibuat dan sedang diproses.');
            return redirect()->to('/produk');

        } catch (\Exception $e) {
            // Jika terjadi error, tampilkan pesan kesalahan
            session()->flash('error', 'Terjadi kesalahan saat memproses transaksi. Silakan coba lagi.');
        }
    }

    /**
     * Render view dan kirim data yang diperlukan.
     */
    public function render()
    {
        // Kalkulasi harga ditaruh di sini agar selalu update saat kuantitas berubah
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
