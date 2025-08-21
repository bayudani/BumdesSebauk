<?php

namespace App\Livewire\Product;

use App\Models\Transaction;
use Livewire\Component;
use Livewire\Attributes\Layout;


#[Layout('layouts.app')]

class Tracking extends Component
{

    public ?Transaction $transaction = null; // Inisialisasi sebagai null
    public $transactionId = '';
    public $searched = false; // Penanda apakah pencarian sudah dilakukan

    /**
     * Cari transaksi saat komponen di-mount, jika ada ID di URL.
     * Route-nya bisa seperti: Route::get('/lacak/{id?}', Tracking::class);
     */
    public function mount($id = null)
    {
        // Jika ada ID di URL (misal: /track/uuid-123), langsung cari transaksinya.
        if ($id) {
            $this->transactionId = $id;
            $this->findTransaction();
        }
        // Jika tidak ada ID (misal: /track), method ini tidak melakukan apa-apa,
        // dan hanya menampilkan form pencarian.
    }

    /**
     * Fungsi untuk mencari transaksi berdasarkan ID yang diinput.
     * Ini adalah method yang akan dipanggil oleh tombol "Lacak".
     */
    public function findTransaction()
    {
        // Validasi sederhana, pastikan ID tidak kosong
        $this->validate(['transactionId' => 'required|string']);

        $this->transaction = Transaction::with('product')
            ->where('transaction_code', $this->transactionId)
            ->first();

        $this->searched = true;

        // Tandai bahwa pencarian sudah dilakukan
        $this->searched = true;
    }

    public function render()
    {
        return view('livewire.product.tracking');
    }
}
