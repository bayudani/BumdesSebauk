<div>
    <div class="bg-gray-50 min-h-screen py-8">
    <div class="max-w-4xl mx-auto px-4">

        @if (session()->has('message'))
            <div class="bg-green-100 border-l-4 border-green-500 text-green-700 p-4 rounded-md mb-6" role="alert">
                <p class="font-bold">Sukses!</p>
                <p>{{ session('message') }}</p>
            </div>
        @endif

        @if ($transaction)
            <div class="bg-white p-6 sm:p-8 rounded-lg shadow-md">
                {{-- Header --}}
                <div class="text-center border-b pb-6 mb-6">
                    <h1 class="text-2xl sm:text-3xl font-bold text-slate-800">Lacak Pesanan Anda</h1>
                    <p class="text-slate-500 mt-2">ID Transaksi:
                        <span class="font-semibold text-purple-600 bg-purple-100 py-1 px-2 rounded">{{ $transaction->id }}</span>
                    </p>
                </div>

                {{-- Status Timeline --}}
                <div class="mb-8">
                    <h2 class="text-lg font-semibold text-slate-700 mb-4">Status Pengiriman</h2>
                    @php
                        $statuses = ['pending', 'processing', 'shipped', 'delivered'];
                        $currentStatusIndex = array_search($transaction->status, $statuses);
                    @endphp
                    <div class="flex items-center">
                        @foreach ($statuses as $index => $status)
                            <div class="flex-1 text-center">
                                <div class="relative mb-2">
                                    {{-- Garis Konektor --}}
                                    @if ($index > 0)
                                        <div class="absolute w-full h-1 top-1/2 transform -translate-y-1/2 -right-1/2
                                            {{ $index <= $currentStatusIndex ? 'bg-purple-500' : 'bg-gray-300' }}">
                                        </div>
                                    @endif
                                    {{-- Lingkaran Status --}}
                                    <div class="w-8 h-8 mx-auto rounded-full text-lg flex items-center justify-center relative z-10
                                        {{ $index <= $currentStatusIndex ? 'bg-purple-500 text-white' : 'bg-gray-300 text-gray-600' }}">
                                        @if ($index <= $currentStatusIndex)
                                            &#10003; <!-- Checkmark -->
                                        @else
                                            {{ $index + 1 }}
                                        @endif
                                    </div>
                                </div>
                                <div class="text-xs sm:text-sm capitalize font-medium {{ $index <= $currentStatusIndex ? 'text-purple-600' : 'text-gray-500' }}">
                                    {{ str_replace('_', ' ', $status) }}
                                </div>
                            </div>
                        @endforeach
                    </div>
                </div>


                {{-- Detail Pesanan --}}
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

                <div class="text-center mt-8 border-t pt-6">
                    <a href="/" class="text-purple-600 hover:text-purple-800 font-medium">
                        &larr; Kembali ke Halaman Utama
                    </a>
                </div>

            </div>
        @else
            <div class="bg-white p-8 rounded-lg shadow-md text-center">
                <h1 class="text-2xl font-bold text-red-600">Transaksi Tidak Ditemukan</h1>
                <p class="text-slate-500 mt-2">Maaf, ID transaksi yang Anda cari tidak ada dalam sistem kami.</p>
                <a href="/" class="mt-6 inline-block bg-purple-500 text-white font-bold py-2 px-4 rounded hover:bg-purple-600">
                    Kembali ke Beranda
                </a>
            </div>
        @endif
    </div>
</div>

</div>
