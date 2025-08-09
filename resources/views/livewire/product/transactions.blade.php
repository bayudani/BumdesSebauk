<div class="bg-white p-4">
    <div class="max-w-7xl mx-auto py-8">

        {{-- Form utama yang di-submit, membungkus semua elemen --}}
        <form wire:submit.prevent="save">
            <div class="grid lg:grid-cols-3 gap-8">

                {{-- KOLOM KANAN (Lebar): Gambar Produk & Data Diri --}}
                <div class="lg:col-span-2 max-lg:order-1">
                    {{-- Detail Produk --}}
                    <div class="mb-8">
                        <h2 class="text-3xl font-semibold text-slate-900 mb-4">{{ $product->name }}</h2>
                        <img src="{{ asset('storage/' . $product->image) }}" alt="{{ $product->name }}"
                            class="w-full h-96 object-cover rounded-lg mb-4">
                        <p class="text-slate-600">{{ $product->description }}</p>
                        <p class="text-slate-600 text-sm"> Stok: {{ $product->stok }}</p>
                    </div>

                    {{-- Form Data Diri --}}
                    <div class="space-y-4">
                        <h3 class="text-xl font-semibold text-slate-900 border-t pt-6">Data Diri Anda</h3>
                        <div>
                            <label for="customer_name" class="block text-sm font-medium text-slate-900 mb-1">Nama
                                Lengkap</label>
                            <input type="text" id="customer_name" wire:model="customer_name"
                                class="px-4 py-3.5 bg-gray-100 text-slate-900 w-full text-sm border border-gray-200 rounded-md focus:border-purple-500 focus:bg-transparent outline-0">
                            @error('customer_name')
                                <span class="text-red-500 text-sm">{{ $message }}</span>
                            @enderror
                        </div>
                        <div>
                            <label for="customer_phone" class="block text-sm font-medium text-slate-900 mb-1">No.
                                Telepon / WA</label>
                            <input type="tel" id="customer_phone" wire:model="customer_phone"
                                class="px-4 py-3.5 bg-gray-100 text-slate-900 w-full text-sm border border-gray-200 rounded-md focus:border-purple-500 focus:bg-transparent outline-0">
                            @error('customer_phone')
                                <span class="text-red-500 text-sm">{{ $message }}</span>
                            @enderror
                        </div>
                        <div>
                            <label for="customer_address" class="block text-sm font-medium text-slate-900 mb-1">Alamat
                                Lengkap</label>
                            <textarea id="customer_address" wire:model="customer_address" rows="3"
                                class="px-4 py-3.5 bg-gray-100 text-slate-900 w-full text-sm border border-gray-200 rounded-md focus:border-purple-500 focus:bg-transparent outline-0"></textarea>
                            @error('customer_address')
                                <span class="text-red-500 text-sm">{{ $message }}</span>
                            @enderror
                        </div>
                    </div>
                </div>

                {{-- KOLOM KIRI (Kecil): Ringkasan & Pembayaran --}}
                <div class="lg:col-span-1 max-lg:order-2 self-start sticky top-8">
                    {{-- Card Ringkasan Pesanan --}}
                    <div class="bg-gray-100 p-6 rounded-md">
                        <h3 class="text-lg font-semibold text-slate-900">Ringkasan Pesanan</h3>
                        <img src="{{ asset('storage/' . $product->image) }}" alt="{{ $product->name }}"
                            class="w-full h-40 object-cover rounded-lg my-4">

                        <div class="flex justify-between items-center">
                            <label for="quantity" class="font-medium">Jumlah:</label>
                            <div class="flex items-center border border-gray-300 rounded-md">
                                <button type="button" wire:click="decrementQuantity"
                                    class="px-3 py-1 text-lg font-bold text-gray-600 hover:bg-gray-200 rounded-l-md">-</button>
                                <input type="text" id="quantity" value="{{ $quantity }}" 
                                    class="w-12 text-center border-0 font-semibold bg-transparent">
                                <button type="button" wire:click="incrementQuantity"
                                    class="px-3 py-1 text-lg font-bold text-gray-600 hover:bg-gray-200 rounded-r-md">+</button>
                            </div>
                        </div>
                        @error('quantity')
                            <div class="text-red-500 text-sm mt-1 text-right">{{ $message }}</div>
                        @enderror

                        <ul class="text-slate-500 font-medium mt-8 space-y-4 border-t pt-4">
                            <li class="flex justify-between text-sm">
                                <span>Harga Satuan</span>
                                <span>Rp {{ number_format($product->price, 0, ',', '.') }}</span>
                            </li>
                            <li class="flex justify-between text-sm">
                                <span>Subtotal</span>
                                <span>Rp {{ number_format($subtotal, 0, ',', '.') }}</span>
                            </li>
                            {{-- <li class="flex justify-between text-sm">
                                <span>Pajak</span>
                                <span>Rp {{ number_format($tax, 0, ',', '.') }}</span>
                            </li> --}}
                            <li
                                class="flex justify-between text-lg font-semibold text-slate-900 border-t border-gray-300 pt-4">
                                <span>Total</span>
                                <span>Rp {{ number_format($totalPrice, 0, ',', '.') }}</span>
                            </li>
                        </ul>
                    </div>

                    {{-- Form Pembayaran --}}
                    <div class="bg-gray-100 p-6 rounded-md mt-8">
                        <h2 class="text-xl font-semibold text-slate-900">Lakukan Pembayaran</h2>
                        <p class="text-slate-500 text-sm mt-2">
                            Silakan transfer ke salah satu rekening berikut, lalu upload bukti transfer.
                        </p>
                        <h3 class="text-lg font-semibold text-slate-900 mt-4">Pilih Rekening Tujuan</h3>
                        <div class="flex flex-col gap-4 mt-4">

                            <label
                                class="flex items-center p-4 border bg-white rounded-lg cursor-pointer has-[:checked]:border-purple-500 has-[:checked]:ring-2 has-[:checked]:ring-purple-200">
                                {{-- TAMBAHKAN wire:model di sini --}}
                                <input type="radio" wire:model="payment_method" value="BCA" class="w-5 h-5">
                                <div class="ml-4">
                                    <p class="font-semibold text-slate-900">Bank BCA</p>
                                    <p class="text-sm text-slate-600">No. Rekening: 1234567890</p>
                                    <p class="text-sm text-slate-600">a.n BUMDes Sebauk</p>
                                </div>
                            </label>

                            <label
                                class="flex items-center p-4 border bg-white rounded-lg cursor-pointer has-[:checked]:border-purple-500 has-[:checked]:ring-2 has-[:checked]:ring-purple-200">
                                {{-- TAMBAHKAN wire:model di sini juga --}}
                                <input type="radio" wire:model="payment_method" value="Mandiri" class="w-5 h-5">
                                <div class="ml-4">
                                    <p class="font-semibold text-slate-900">Bank Mandiri</p>
                                    <p class="text-sm text-slate-600">No. Rekening: 0987654321</p>
                                    <p class="text-sm text-slate-600">a.n BUMDes Sebauk</p>
                                </div>
                            </label>
                        </div>
                        @error('payment_method')
                            <span class="text-red-500 text-sm">{{ $message }}</span>
                        @enderror

                        <div class="mt-6">
                            <label class="block text-sm font-medium text-slate-900 mb-2">Upload Bukti Transfer</label>
                            <input type="file" wire:model="proof_of_transaction" class="block w-full text-sm">
                            @error('proof_of_transaction')
                                <span class="text-red-500 text-sm">{{ $message }}</span>
                            @enderror
                            <div wire:loading wire:target="proof_of_transaction" class="text-sm text-gray-500 mt-1">
                                Uploading...
                            </div>
                        </div>
                    </div>

                    {{-- Tombol Submit di paling bawah --}}
                    <button type="submit"
                        class="w-full mt-8 py-3 text-lg font-medium bg-purple-500 text-white rounded-md hover:bg-purple-600 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-purple-500 disabled:opacity-50"
                        wire:loading.attr="disabled">
                        <span wire:loading.remove wire:target="save">Konfirmasi Pembayaran</span>
                        <span wire:loading wire:target="save">Memproses...</span>
                    </button>
                </div>

            </div>
        </form>

    </div>
</div>
