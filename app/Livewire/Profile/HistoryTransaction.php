<?php

namespace App\Livewire\Profile;

use App\Models\Transaction;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;
use Livewire\WithPagination;

class HistoryTransaction extends Component
{
    // Gunakan trait ini untuk pagination
    use WithPagination;

    // Properti untuk menampung nilai dari filter dropdown
    public $filterStatus = 'all';

    /**
     * Method untuk menandai pesanan sebagai 'completed' oleh user.
     */
    public function confirmOrder($transactionId)
    {
        // Cari transaksi berdasarkan ID
        $transaction = Transaction::find($transactionId);

        // [PENTING] Keamanan: Pastikan transaksi ada dan milik user yang sedang login
        if ($transaction && $transaction->user_id == Auth::id()) {
            
            // Cek kondisi, misalnya hanya bisa dikonfirmasi jika statusnya 'processing'
            if ($transaction->order_status == 'processing') {
                $transaction->update([
                    'order_status' => 'completed',
                    'transaction_status' => 'completed' // Update juga status transaksi utama
                ]);

                // Kirim pesan sukses
                session()->flash('message', 'Pesanan #' . $transaction->transaction_code . ' telah ditandai selesai!');
            }
        }
    }

    public function render()
    {
        // Mulai query untuk mengambil transaksi milik user yang login
        $transactionsQuery = Transaction::with('product') // Eager load relasi produk
                                        ->where('user_id', Auth::id());

        // Terapkan filter berdasarkan status jika bukan 'all'
        if ($this->filterStatus !== 'all') {
            $transactionsQuery->where('order_status', $this->filterStatus);
        }

        // Ambil data dengan urutan terbaru dan pagination
        $transactions = $transactionsQuery->latest()->paginate(10);

        return view('livewire.profile.history-transaction', [
            'transactions' => $transactions,
        ]);
    }
}