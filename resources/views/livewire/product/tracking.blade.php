<div>
    <div class="bg-gray-50 min-h-screen py-8">
        <div class="max-w-4xl mx-auto px-4">

            <!-- Form Pencarian (Tetap Sama) -->
            <div class="bg-white p-6 rounded-lg shadow-md mb-8">
                <h2 class="text-xl font-bold text-slate-800 mb-4">Lacak Pesanan Anda</h2>
                <div class="flex flex-col sm:flex-row gap-2">
                    <input type="text" wire:model.defer="transactionId" wire:keydown.enter="findTransaction"
                        placeholder="Masukkan ID Transaksi..."
                        class="flex-grow border-gray-300 rounded-md shadow-sm focus:ring-purple-500 focus:border-green-500">
                    <button wire:click="findTransaction"
                        class="px-6 py-2 bg-green-500 text-white font-semibold rounded-md hover:bg-green-700 disabled:opacity-50"
                        wire:loading.attr="disabled">
                        <span wire:loading.remove wire:target="findTransaction">Lacak</span>
                        <span wire:loading wire:target="findTransaction">Mencari...</span>
                    </button>
                </div>
                @error('transactionId')
                    <span class="text-red-500 text-sm mt-1">{{ $message }}</span>
                @enderror
            </div>

            <!-- [PENTING] Kondisi untuk menampilkan hasil -->
            @if ($transaction)
                <div class="bg-white p-6 sm:p-8 rounded-lg shadow-md">
                    <!-- Header (Tetap Sama) -->
                    <div class="text-center border-b pb-6 mb-6">
                        <h1 class="text-2xl sm:text-3xl font-bold text-slate-800">Detail Pesanan</h1>
                        <p class="text-slate-500 mt-2">ID Transaksi:
                            <span
                                class="font-semibold text-purple-600 bg-purple-100 py-1 px-2 rounded-md">{{ $transaction->transaction_code }}</span>
                        </p>
                    </div>

                    <!-- [UPGRADE] Tampilan Status dengan Timeline Visual -->
                    <div class="mb-8">
                        @php
                            // Daftar status sesuai alur proses
                            $statuses = ['pending', 'processing', 'completed'];
                            // Cari posisi (index) dari status pesanan saat ini
                            $currentStatusIndex = array_search($transaction->order_status, $statuses);
                        @endphp

                        @if ($transaction->order_status == 'cancelled')
                            <!-- Tampilan Khusus Jika Dibatalkan -->
                            <div class="text-center p-4 bg-red-50 rounded-lg">
                                <span
                                    class="flex h-12 w-12 mb-4 items-center justify-center rounded-full bg-red-200 ring-8 ring-white mx-auto">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 text-red-700" fill="none"
                                        viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                                        <path stroke-linecap="round" stroke-linejoin="round" d="M6 18L18 6M6 6l12 12" />
                                    </svg>
                                </span>
                                <h4 class="mb-2 text-lg font-semibold text-red-800">Pesanan Dibatalkan</h4>
                                <p class="text-sm text-slate-600">Pesanan ini telah dibatalkan.</p>
                            </div>
                        @else
                            <!-- Timeline Normal -->
                            <ol class="grid grid-cols-1 sm:grid-cols-3 gap-8 relative">
                                <!-- Garis Latar Belakang -->
                                <div class="absolute top-4 left-0 w-full h-0.5 bg-gray-200 -z-10"></div>
                                @php
                                    $progressPercentage =
                                        $currentStatusIndex > 0
                                            ? ($currentStatusIndex / (count($statuses) - 1)) * 100
                                            : 0;
                                @endphp
                                <div class="absolute top-4 left-0 h-0.5 bg-green-500 transition-all duration-500"
                                    style="width: {{ $progressPercentage }}%;"></div>

                                <!-- Step 1: Pesanan Dibuat (Pending) -->
                                @php $stepIndex = 0; @endphp
                                <li class="text-center">
                                    <span
                                        class="flex h-9 w-9 mb-4 mx-auto items-center justify-center rounded-full ring-8 ring-white {{ $currentStatusIndex >= $stepIndex ? 'bg-green-500 text-white' : 'bg-gray-200 text-gray-600' }}">
                                        @if ($currentStatusIndex > $stepIndex)
                                            <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 20 20">
                                                <path
                                                    d="M16.704 4.153a.75.75 0 01.143 1.052l-8 10.5a.75.75 0 01-1.127.075l-4.5-4.5a.75.75 0 011.06-1.06l3.894 3.893 7.48-9.817a.75.75 0 011.052-.143z" />
                                            </svg>
                                        @else
                                            1
                                        @endif
                                    </span>
                                    <h4 class="mb-1 text-[15px] font-semibold text-slate-900">Pesanan Dibuat</h4>
                                    <p class="text-sm text-slate-600">Menunggu konfirmasi</p>
                                </li>

                                <!-- Step 2: Diproses (Processing) -->
                                @php $stepIndex = 1; @endphp
                                <li class="text-center">
                                    <span
                                        class="flex h-9 w-9 mb-4 mx-auto items-center justify-center rounded-full ring-8 ring-white {{ $currentStatusIndex >= $stepIndex ? 'bg-green-500 text-white' : 'bg-gray-200 text-gray-600' }}">
                                        @if ($currentStatusIndex > $stepIndex)
                                            <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 20 20">
                                                <path
                                                    d="M16.704 4.153a.75.75 0 01.143 1.052l-8 10.5a.75.75 0 01-1.127.075l-4.5-4.5a.75.75 0 011.06-1.06l3.894 3.893 7.48-9.817a.75.75 0 011.052-.143z" />
                                            </svg>
                                        @else
                                            2
                                        @endif
                                    </span>
                                    <h4 class="mb-1 text-[15px] font-semibold text-slate-900">Diproses</h4>
                                    <p class="text-sm text-slate-600">Pesanan sedang disiapkan</p>
                                </li>

                                <!-- Step 3: Selesai (Completed) -->
                                @php $stepIndex = 2; @endphp
                                <li class="text-center">
                                    <span
                                        class="flex h-9 w-9 mb-4 mx-auto items-center justify-center rounded-full ring-8 ring-white {{ $currentStatusIndex >= $stepIndex ? 'bg-green-500 text-white' : 'bg-gray-200 text-gray-600' }}">
                                        @if ($currentStatusIndex >= $stepIndex)
                                            <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 20 20">
                                                <path
                                                    d="M16.704 4.153a.75.75 0 01.143 1.052l-8 10.5a.75.75 0 01-1.127.075l-4.5-4.5a.75.75 0 011.06-1.06l3.894 3.893 7.48-9.817a.75.75 0 011.052-.143z" />
                                            </svg>
                                        @else
                                            3
                                        @endif
                                    </span>
                                    <h4 class="mb-1 text-[15px] font-semibold text-slate-900">Selesai</h4>
                                    @if ($transaction->delivery_method == 'pickup')
                                        <p class="text-sm text-slate-600">Pesanan telah diambil</p>
                                    @else
                                        <p class="text-sm text-slate-600">Pesanan telah diterima</p>
                                    @endif
                                </li>
                            </ol>
                        @endif
                    </div>

                    <!-- Detail Pesanan & Info Pengiriman (Tetap Sama) -->
                    <div class="grid md:grid-cols-2 gap-8 border-t pt-8 mt-8">
                        <div>
                            <h3 class="text-lg font-semibold text-slate-700 mb-3">Ringkasan Pesanan</h3>
                            <div class="flex items-center space-x-4 p-4 bg-gray-50 rounded-lg">

                                @php
                                    // Cek apakah ada gambar di relasi 'images', jika ada, ambil yang pertama.
                                    // Jika tidak ada, pakai gambar utama dari tabel 'products' sebagai fallback.
                                    // Logika yang benar
                                    $displayImage =
                                        $transaction->product->images->first()->image ?? $transaction->product->image;
                                @endphp

                                <img src="{{ asset('storage/' . $displayImage) }}"
                                    alt="{{ $transaction->product->name }}" class="w-20 h-20 object-cover rounded-md">
                                <div>
                                    <p class="font-semibold text-slate-800">{{ $transaction->product->name }}</p>
                                    <p class="text-sm text-slate-600">Jumlah: {{ $transaction->quantity }}</p>
                                    <p class="text-sm text-slate-600 font-bold">Total: Rp
                                        {{ number_format($transaction->total_amount, 0, ',', '.') }}</p>
                                </div>
                            </div>
                        </div>
                        <div>
                            <h3 class="text-lg font-semibold text-slate-700 mb-3">Info Pengiriman</h3>
                            <div class="space-y-2 text-sm text-slate-600 p-4 bg-gray-50 rounded-lg">
                                <p><span class="font-semibold text-slate-800">Nama:</span>
                                    {{ $transaction->customer_name }}</p>
                                <p><span class="font-semibold text-slate-800">Telepon:</span>
                                    {{ $transaction->customer_phone }}</p>
                                <p><span class="font-semibold text-slate-800">Alamat:</span>
                                    {{ $transaction->customer_address }}</p>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- [PENTING] Kondisi jika transaksi tidak ditemukan SETELAH mencari -->
            @elseif($searched)
                <div class="bg-white p-8 rounded-lg shadow-md text-center">
                    <h1 class="text-2xl font-bold text-red-600">Transaksi Tidak Ditemukan</h1>
                    <p class="text-slate-500 mt-2">Maaf, ID transaksi <span
                            class="font-semibold">{{ $transactionId }}</span> tidak ada dalam sistem kami.</p>
                </div>
            @endif
        </div>
    </div>
</div>
