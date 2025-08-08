<div>
    <div class="bg-white p-4">
        <div class="md:max-w-5xl max-w-xl mx-auto py-8">
            <div class="grid md:grid-cols-2 lg:grid-cols-3 gap-8">
                <div class="lg:col-span-2 max-md:order-1">

                    <div class="mb-8">
                        <h2 class="text-3xl font-semibold text-slate-900 mb-4">{{ $product->name }}</h2>
                        <img src="{{ asset('storage/' . $product->image) }}" alt="{{ $product->name }}"
                            class="w-full h-60 object-cover rounded-lg mb-4">
                        <p class="text-slate-600">{{ $product->description }}</p>
                        <p class="text-slate-600 text-sm"> Stok: {{ $product->stok }}</p>
                    </div>

                    {{-- Form utama yang di-submit --}}
                    <form wire:submit.prevent="save">

                        <div class="space-y-4">
                            <h3 class="text-lg font-semibold text-slate-900 border-t pt-4 mt-4">Data Diri Anda</h3>
                            <div>
                                <label for="customer_name" class="block text-sm font-medium text-slate-900 mb-1">Nama
                                    Lengkap</label>
                                <input type="text" id="customer_name" wire:model="customer_name"
                                    class="w-full border-gray-300 rounded-md">
                                @error('customer_name')
                                    <span class="text-red-500 text-sm">{{ $message }}</span>
                                @enderror
                            </div>
                            <div>
                                <label for="customer_phone" class="block text-sm font-medium text-slate-900 mb-1">No.
                                    Telepon / WA</label>
                                <input type="tel" id="customer_phone" wire:model="customer_phone"
                                    class="w-full border-gray-300 rounded-md">
                                @error('customer_phone')
                                    <span class="text-red-500 text-sm">{{ $message }}</span>
                                @enderror
                            </div>
                            <div>
                                <label for="customer_address"
                                    class="block text-sm font-medium text-slate-900 mb-1">Alamat Lengkap</label>
                                <textarea id="customer_address" wire:model="customer_address" rows="3" class="w-full border-gray-300 rounded-md"></textarea>
                                @error('customer_address')
                                    <span class="text-red-500 text-sm">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>

                        <div class="mt-8">
                            <h2 class="text-2xl font-semibold text-slate-900">Lakukan Pembayaran</h2>
                            <p class="text-slate-500 text-sm mt-2">
                                Silakan transfer ke salah satu rekening berikut, lalu upload bukti transfer.
                            </p>
                            <h3 class="text-lg font-semibold text-slate-900">Pilih Rekening Tujuan</h3>
                            <div class="flex flex-col gap-4 mt-4" wire:model="payment_method">
                                <label
                                    class="flex items-center p-4 border rounded-lg cursor-pointer hover:border-purple-500">
                                    <input type="radio" name="bank" class="w-5 h-5" checked>
                                    <div class="ml-4">
                                        <p class="font-semibold text-slate-900">Bank BCA</p>
                                        <p class="text-sm text-slate-600">No. Rekening: 1234567890</p>
                                        <p class="text-sm text-slate-600">a.n BUMDes Makmur Jaya</p>
                                    </div>
                                </label>
                                <label
                                    class="flex items-center p-4 border rounded-lg cursor-pointer hover:border-purple-500">
                                    <input type="radio" name="bank" class="w-5 h-5" checked>
                                    <div class="ml-4">
                                        <p class="font-semibold text-slate-900">Bank BCA</p>
                                        <p class="text-sm text-slate-600">No. Rekening: 1234567890</p>
                                        <p class="text-sm text-slate-600">a.n BUMDes Makmur Jaya</p>
                                    </div>
                                </label>
                            </div>
                            @error('payment_method')
                                <span class="text-red-500 text-sm">{{ $message }}</span>
                            @enderror
                        </div>

                        <div class="mt-8">
                            <label class="block text-sm font-medium text-slate-900 mb-2">Upload Bukti Transfer</label>
                            <input type="file" wire:model="proof_of_transaction" class="block w-full text-sm">
                            @error('proof_of_transaction')
                                <span class="text-red-500 text-sm">{{ $message }}</span>
                            @enderror

                            {{-- Indikator loading saat upload --}}
                            <div wire:loading wire:target="proof_of_transaction" class="text-sm text-gray-500 mt-1">
                                Uploading...</div>
                        </div>

                        <button type="submit"
                            class="w-full mt-8 py-3 text-lg font-medium bg-purple-500 text-white rounded-md hover:bg-purple-600">
                            Konfirmasi Pembayaran
                        </button>
                    </form>



                    {{-- <div class="mt-8 max-w-lg">
                        <h3 class="text-lg font-semibold text-slate-900">Pilih Rekening Tujuan</h3>
                        <div class="flex flex-col gap-4 mt-6">
                            <label class="flex items-center p-4 border rounded-lg cursor-pointer hover:border-purple-500">
                                <input type="radio" name="bank" class="w-5 h-5" checked>
                                <div class="ml-4">
                                    <p class="font-semibold text-slate-900">Bank BCA</p>
                                    <p class="text-sm text-slate-600">No. Rekening: 1234567890</p>
                                    <p class="text-sm text-slate-600">a.n BUMDes Makmur Jaya</p>
                                </div>
                            </label>
                            </div>

                        <form class="mt-8 space-y-4">
                            <div>
                                <label class="block text-sm font-medium text-slate-900 mb-2">
                                    Upload Bukti Transfer
                                </label>
                                <input type="file" accept="image/*" class="block w-full text-sm text-gray-900 border border-gray-200 rounded-md cursor-pointer bg-gray-50 focus:outline-none focus:border-purple-500">
                            </div>

                            <button type="submit" class="w-40 py-3 text-[15px] font-medium bg-purple-500 text-white rounded-md hover:bg-purple-600 tracking-wide">
                                Kirim
                            </button>
                        </form>
                    </div> --}}
                </div>

                <div class="bg-gray-100 p-6 rounded-md self-start sticky top-8">
                    <h3 class="text-lg font-semibold text-slate-900">Ringkasan Pesanan</h3>
                    <img src="{{ asset('storage/' . $product->image) }}" alt="{{ $product->name }}"
                        class="w-full h-40 object-cover rounded-lg my-4">

                    <div class="flex justify-between items-center">
                        <label for="quantity" class="font-medium">Jumlah:</label>
                        <div class="flex items-center border border-gray-300 rounded-md">
                            {{-- Tombol Kurang --}}
                            <button type="button" wire:click="decrementQuantity"
                                class="px-3 py-1 text-lg font-bold text-gray-600 hover:bg-gray-100">-</button>

                            {{-- Tampilan Angka --}}
                            <input type="text" id="quantity" value="{{ $quantity }}" readonly
                                class="w-12 text-center border-0 font-semibold">

                            {{-- Tombol Tambah --}}
                            <button type="button" wire:click="incrementQuantity"
                                class="px-3 py-1 text-lg font-bold text-gray-600 hover:bg-gray-100">+</button>
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
                        <li class="flex justify-between text-sm">
                            <span>Pajak (11%)</span>
                            <span>Rp {{ number_format($tax, 0, ',', '.') }}</span>
                        </li>
                        <li
                            class="flex justify-between text-lg font-semibold text-slate-900 border-t border-gray-300 pt-4">
                            <span>Total</span>
                            <span>Rp {{ number_format($totalPrice, 0, ',', '.') }}</span>
                        </li>
                    </ul>
                </div>

            </div>
        </div>
    </div>
</div>
