<div>
    <div class="bg-gray-50 min-h-screen py-8">
        <div class="max-w-4xl mx-auto px-4">

            <!-- Form Pencarian -->
            <div class="bg-white p-6 rounded-lg shadow-md mb-8">
                <h2 class="text-xl font-bold text-slate-800 mb-4">Lacak Pesanan Anda</h2>
                <div class="flex gap-2">
                    <input type="text" wire:model="transactionId" placeholder="Masukkan ID Transaksi..." class="flex-grow border-gray-300 rounded-md shadow-sm">
                    <button wire:click="findTransaction" class="px-6 py-2 bg-purple-600 text-white font-semibold rounded-md hover:bg-purple-700">
                        Lacak
                    </button>
                </div>
            </div>

            @if ($transaction)
                <div class="bg-white p-6 sm:p-8 rounded-lg shadow-md">
                    <!-- Header -->
                    <div class="text-center border-b pb-6 mb-6">
                        <h1 class="text-2xl sm:text-3xl font-bold text-slate-800">Detail Pesanan</h1>
                        <p class="text-slate-500 mt-2">ID Transaksi:
                            <span class="font-semibold text-purple-600 bg-purple-100 py-1 px-2 rounded">{{ $transaction->id }}</span>
                            <br/>
                            <span class="font-light text-black text-xs">Simpan id transaksi ini untuk melacak transaksi anda</span>
                        </p>
                    </div>

                    <!-- Status Pesanan (Versi Simpel) -->
                    <div class="mb-8">
                        <h2 class="text-lg font-semibold text-slate-700 mb-4 text-center">Status Saat Ini</h2>
                        <div class="p-4 rounded-lg text-center">
                            
                            @if ($transaction->status == 'completed')
                                <span class="inline-flex items-center px-4 py-2 bg-green-100 text-green-800 text-lg font-bold rounded-full">
                                    <svg class="w-6 h-6 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path></svg>
                                    Pesanan Selesai
                                </span>
                                <p class="mt-2 text-slate-500">Transaksi anda telah dikonfirmasi.</p>
                            
                            @elseif ($transaction->status == 'pending')
                                <span class="inline-flex items-center px-4 py-2 bg-yellow-100 text-yellow-800 text-lg font-bold rounded-full">
                                    <svg class="w-6 h-6 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
                                    Sedang Diproses
                                </span>
                                <p class="mt-2 text-slate-500">Transaksi anda sedang diproses.</p>

                            @elseif ($transaction->status == 'canceled')
                                <span class="inline-flex items-center px-4 py-2 bg-red-100 text-red-800 text-lg font-bold rounded-full">
                                    <svg class="w-6 h-6 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path></svg>
                                    Pesanan Dibatalkan
                                </span>
                                <p class="mt-2 text-slate-500">Pesanan ini telah dibatalkan.</p>
                            @endif
                        </div>
                    </div>

                    <!-- Detail Pesanan & Info Pengiriman (Tetap Sama) -->
                    <div class="grid md:grid-cols-2 gap-8 border-t pt-6">
                        <div>
                            <h3 class="text-lg font-semibold text-slate-700 mb-3">Ringkasan Pesanan</h3>
                            <div class="flex items-center space-x-4 p-4 bg-gray-50 rounded-lg">
                                <img src="{{ asset('storage/' . $transaction->product->image) }}" alt="{{ $transaction->product->name }}" class="w-20 h-20 object-cover rounded-md">
                                <div>
                                    <p class="font-semibold text-slate-800">{{ $transaction->product->name }}</p>
                                    <p class="text-sm text-slate-600">Jumlah: {{ $transaction->quantity }}</p>
                                    <p class="text-sm text-slate-600 font-bold">Total: Rp {{ number_format($transaction->total_amount, 0, ',', '.') }}</p>
                                </div>
                            </div>
                        </div>
                        <div>
                            <h3 class="text-lg font-semibold text-slate-700 mb-3">Info Pengiriman</h3>
                            <div class="space-y-2 text-sm text-slate-600 p-4 bg-gray-50 rounded-lg">
                                <p><span class="font-semibold text-slate-800">Nama:</span> {{ $transaction->customer_name }}</p>
                                <p><span class="font-semibold text-slate-800">Telepon:</span> {{ $transaction->customer_phone }}</p>
                                <p><span class="font-semibold text-slate-800">Alamat:</span> {{ $transaction->customer_address }}</p>
                            </div>
                        </div>
                    </div>
                </div>
            @elseif(request()->query('id'))
                <div class="bg-white p-8 rounded-lg shadow-md text-center">
                    <h1 class="text-2xl font-bold text-red-600">Transaksi Tidak Ditemukan</h1>
                    <p class="text-slate-500 mt-2">Maaf, ID transaksi yang Anda cari tidak ada dalam sistem kami.</p>
                </div>
            @endif
        </div>
    </div>
</div>
