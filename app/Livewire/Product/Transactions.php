<?php

namespace App\Livewire\Product;

use Livewire\Attributes\Layout;
use Livewire\Component;
use App\Models\Product as ProductModel;
use App\Models\Transaction;
use Livewire\WithFileUploads;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;
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
        
        // Definisikan variabel di luar closure agar bisa diakses nanti
        $newTransaction = null;

        try {
            // Gunakan Database Transaction dan oper variabel $newTransaction by reference
            DB::transaction(function () use (&$newTransaction) {
                // Hitung total harga
                $totalAmount = $this->product->price * $this->quantity;

                // Simpan file bukti transfer
                $path = $this->proof_of_transaction->store('proofs', 'public');

                // Buat record transaksi baru dan simpan instance-nya ke variabel
                // ID akan di-generate otomatis oleh model (UUID)
                $newTransaction = Transaction::create([
                    'product_id' => $this->product->id,
                    'customer_name' => $this->customer_name,
                    'customer_address' => $this->customer_address,
                    'customer_phone' => $this->customer_phone,
                    'quantity' => $this->quantity,
                    'total_amount' => $totalAmount,
                    'status' => 'pending', // Status awal: Menunggu Konfirmasi
                    'transaction_date' => now(),
                    'payment_method' => $this->payment_method,
                    'proof_of_transaction' => $path,
                ]);

                // Kurangi stok produk
                $this->product->decrement('stok', $this->quantity);
            });

            // Jika transaksi DB berhasil, $newTransaction tidak akan null lagi
            if ($newTransaction) {
                session()->flash('message', 'Transaksi berhasil! Simpan ID Transaksi Anda untuk melacak pesanan.');
                // Redirect ke route 'tracking' dengan membawa ID transaksi (UUID)
                return redirect()->route('tracking', ['id' => $newTransaction->id]);
            }

        } catch (\Exception $e) {
            // Jika terjadi error, tampilkan pesan kesalahan
            session()->flash('error', 'Terjadi kesalahan saat memproses transaksi. Silakan coba lagi. Error: ' . $e->getMessage());
        }
    }

    /**
     * Render view dan kirim data yang diperlukan.
     */
    public function render()
    {
        $subtotal = $this->product->price * $this->quantity;
        // $tax = $subtotal * 0.11;
        $totalPrice = $subtotal;

        return view('livewire.product.transactions', [
            'subtotal' => $subtotal,
            // 'tax' => $tax,
            'totalPrice' => $totalPrice,
        ]);
    }
}
