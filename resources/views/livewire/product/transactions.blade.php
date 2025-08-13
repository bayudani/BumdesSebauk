<div class="bg-white p-4">
    <div class="max-w-7xl mx-auto py-8">

        {{-- Notifikasi --}}
        @if (session()->has('message'))
            <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded relative mb-6"
                role="alert">
                <strong class="font-bold">Berhasil!</strong>
                <span class="block sm:inline">{{ session('message') }}</span>
            </div>
        @endif
        @if (session()->has('error'))
            <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded relative mb-6" role="alert">
                <strong class="font-bold">Oops!</strong>
                <span class="block sm:inline">{{ session('error') }}</span>
            </div>
        @endif

        <form wire:submit.prevent="save">
            <div class="grid lg:grid-cols-3 gap-8">

                {{-- KOLOM KIRI: Detail Produk & Form Data Diri --}}
                <div class="lg:col-span-2">

                    <div class="mb-8">
                        <h2 class="text-3xl font-semibold text-slate-900 mb-6">{{ $product->name }}</h2>

                        <div x-data="{
                            mediaItems: {{ $product->images->toJson() }},
                            mainDisplay: '{{ $product->images->first() ? Storage::disk('public')->url($product->images->first()->image) : asset('storage/' . $product->image) }}',
                            mainMediaType: '{{ $product->images->first()->media_type ?? 'image' }}'
                        }" class="grid grid-cols-1 lg:grid-cols-5 gap-6 mb-6">

                            <div class="lg:col-span-1 order-last lg:order-first">
                                <div class="flex lg:flex-col gap-3">
                                    <template x-for="media in mediaItems" :key="media.id">
                                        <div @click="mainDisplay = '{{ Storage::disk('public')->url('') }}/' + media.image; mainMediaType = media.media_type"
                                            class="w-full aspect-square p-1 border-2 rounded-lg cursor-pointer transition-all"
                                            :class="{
                                                'border-purple-600': mainDisplay.includes(media
                                                    .image),
                                                'border-transparent': !mainDisplay.includes(media.image)
                                            }">

                                            <template x-if="media.media_type === 'image'">
                                                <img :src="'{{ Storage::disk('public')->url('') }}/' + media.image"
                                                    alt="{{ $product->name }}"
                                                    class="w-full h-full object-cover rounded-md">
                                            </template>
                                            <template x-if="media.media_type === 'video'">
                                                <div
                                                    class="relative w-full h-full bg-black rounded-md flex items-center justify-center">
                                                    <video
                                                        :src="'{{ Storage::disk('public')->url('') }}/' + media.image"
                                                        class="w-full h-full object-cover rounded-md"></video>
                                                    <div
                                                        class="absolute text-white bg-black bg-opacity-50 rounded-full p-2 pointer-events-none">
                                                        <svg class="w-6 h-6" fill="currentColor" viewBox="0 0 20 20">
                                                            <path
                                                                d="M6.3 2.841A1.5 1.5 0 004 4.11V15.89a1.5 1.5 0 002.3 1.269l9.344-5.89a1.5 1.5 0 000-2.538L6.3 2.84z">
                                                            </path>
                                                        </svg>
                                                    </div>
                                                </div>
                                            </template>
                                        </div>
                                    </template>
                                </div>
                            </div>

                            <div class="lg:col-span-4 w-full aspect-[4/3]">
                                <template x-if="mainMediaType === 'image'">
                                    <img :src="mainDisplay" alt="{{ $product->name }}"
                                        class="w-full h-full object-cover rounded-xl shadow-lg">
                                </template>
                                <template x-if="mainMediaType === 'video'">
                                    <video controls autoplay muted loop :src="mainDisplay"
                                        class="w-full h-full object-cover rounded-xl shadow-lg bg-black">
                                        Browser Anda tidak mendukung tag video.
                                    </video>
                                </template>
                            </div>
                        </div>

                        <p class="text-slate-600 leading-relaxed">{{ $product->description }}</p>
                        <p class="text-slate-600 text-sm mt-2"> Stok: {{ $product->stok }}</p>

                        <div class="flex items-center justify-between mt-4">
                            <p class="text-slate-600 text-sm">Stok: <span
                                    class="font-semibold">{{ $product->stok }}</span></p>

                            @php
                                // Siapkan nomor admin dan pesan default
                                $adminPhoneNumber = '62895385526493'; // GANTI DENGAN NOMOR ADMIN (awali dengan 62)
                                $productUrl = route('checkout', $product->id);
                                $message = "Halo Admin, saya tertarik dengan produk '{$product->name}'. Apakah masih tersedia?\n\nLink Produk: {$productUrl}";
                                $whatsappUrl =
                                    'https://api.whatsapp.com/send?phone=' .
                                    $adminPhoneNumber .
                                    '&text=' .
                                    urlencode($message);
                            @endphp

                            <a href="{{ $whatsappUrl }}" target="_blank"
                                class="inline-flex items-center gap-2 px-4 py-2 text-sm font-semibold text-white bg-green-500 rounded-lg shadow-md hover:bg-green-600 focus:outline-none focus:ring-2 focus:ring-green-500 focus:ring-offset-2 transition">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" viewBox="0 0 20 20"
                                    fill="currentColor">
                                    <path d="M10 2a8 8 0 100 16 8 8 0 000-16zM2 10a8 8 0 1116 0 8 8 0 01-16 0z"
                                        clip-rule="evenodd" />
                                    <path
                                        d="M12.293 7.293a1 1 0 011.414 1.414l-3 3a1 1 0 01-1.414 0l-1.5-1.5a1 1 0 111.414-1.414L10 9.586l2.293-2.293z"
                                        clip-rule="evenodd" />
                                </svg>
                                <span>Chat Admin</span>
                            </a>
                        </div>

                    </div>
                    {{-- Form Data Diri (Tidak Berubah) --}}
                    <div class="space-y-4 border-t pt-6">
                        <h3 class="text-xl font-semibold text-slate-900">Data Pemesan</h3>
                        <p class="text-sm text-slate-500">Jika Anda sudah login, data akan terisi otomatis.</p>
                        <div>
                            <label for="customer_name" class="block text-sm font-medium text-slate-900 mb-1">Nama
                                Lengkap</label>
                            <input type="text" id="customer_name" wire:model.lazy="customer_name"
                                class="px-4 py-3.5 bg-gray-100 text-slate-900 w-full text-sm border border-gray-200 rounded-md focus:border-green-500 focus:bg-transparent outline-0">
                            @error('customer_name')
                                <span class="text-red-500 text-sm">{{ $message }}</span>
                            @enderror
                        </div>
                        <div>
                            <label for="customer_phone" class="block text-sm font-medium text-slate-900 mb-1">No.
                                Telepon / WA</label>
                            <input type="tel" id="customer_phone" wire:model.lazy="customer_phone"
                                class="px-4 py-3.5 bg-gray-100 text-slate-900 w-full text-sm border border-gray-200 rounded-md focus:border-green-500 focus:bg-transparent outline-0">
                            @error('customer_phone')
                                <span class="text-red-500 text-sm">{{ $message }}</span>
                            @enderror
                        </div>
                        <div>
                            <label for="customer_address" class="block text-sm font-medium text-slate-900 mb-1">Alamat
                                Lengkap</label>
                            <textarea id="customer_address" wire:model.lazy="customer_address" rows="3"
                                class="px-4 py-3.5 bg-gray-100 text-slate-900 w-full text-sm border border-gray-200 rounded-md focus:border-green-500 focus:bg-transparent outline-0"></textarea>
                            @error('customer_address')
                                <span class="text-red-500 text-sm">{{ $message }}</span>
                            @enderror
                        </div>
                    </div>
                </div>
                {{-- KOLOM KANAN: Ringkasan, Pengiriman & Pembayaran (Tidak Berubah) --}}
                <div class="lg:col-span-1 self-start lg:sticky top-8">
                    <div class="bg-gray-100 p-6 rounded-md space-y-8">
                        <div>
                            <h3 class="text-lg font-semibold text-slate-900">Ringkasan Pesanan</h3>
                            <div class="flex justify-between items-center mt-4">
                                <label for="quantity" class="font-medium">Jumlah:</label>
                                <div class="flex items-center border border-gray-300 rounded-md bg-white">
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
                            <ul class="text-slate-600 font-medium mt-6 space-y-3 border-t border-gray-300 pt-4">
                                <li class="flex justify-between text-sm">
                                    <span>Harga Satuan</span>
                                    <span>Rp {{ number_format($product->price, 0, ',', '.') }}</span>
                                </li>
                                <li class="flex justify-between text-sm">
                                    <span>Subtotal</span>
                                    <span>Rp {{ number_format($subtotal, 0, ',', '.') }}</span>
                                </li>
                                <li
                                    class="flex justify-between text-lg font-semibold text-slate-900 border-t border-gray-300 pt-3 mt-3">
                                    <span>Total</span>
                                    <span>Rp {{ number_format($totalPrice, 0, ',', '.') }}</span>
                                </li>
                            </ul>
                        </div>
                        <div class="border-t pt-6">
                            <h3 class="text-lg font-semibold text-slate-900">Metode Pengiriman</h3>
                            <div class="flex flex-col gap-3 mt-4">
                                <label
                                    class="flex items-center p-3 border bg-white rounded-lg cursor-pointer has-[:checked]:border-green-500 has-[:checked]:ring-2 has-[:checked]:ring-purple-200">
                                    <input type="radio" wire:model="delivery_method" value="pickup"
                                        class="w-5 h-5">
                                    <div class="ml-3">
                                        <p class="font-semibold text-slate-900">Ambil di Tempat (Pickup)</p>
                                        <p class="text-sm text-slate-600">Gratis, ambil langsung di lokasi kami.</p>
                                    </div>
                                </label>
                                <label
                                    class="flex items-center p-3 border bg-white rounded-lg cursor-pointer has-[:checked]:border-green-500 has-[:checked]:ring-2 has-[:checked]:ring-purple-200">
                                    <input type="radio" wire:model="delivery_method" value="delivery"
                                        class="w-5 h-5">
                                    <div class="ml-3">
                                        <p class="font-semibold text-slate-900">Diantar (Delivery)</p>
                                        <p class="text-sm text-slate-600">Akan ada biaya tambahan, dihubungi terpisah.
                                        </p>
                                    </div>
                                </label>
                            </div>
                            @error('delivery_method')
                                <span class="text-red-500 text-sm mt-1">{{ $message }}</span>
                            @enderror
                        </div>
                        <div class="border-t pt-6">
                            <h3 class="text-lg font-semibold text-slate-900">Pembayaran</h3>
                            <p class="text-slate-500 text-sm mt-2">Silakan transfer ke rekening tujuan, lalu upload
                                bukti.</p>
                            <div class="flex flex-col gap-3 mt-4">
                                <label
                                    class="flex items-center p-3 border bg-white rounded-lg cursor-pointer has-[:checked]:border-green-500 has-[:checked]:ring-2 has-[:checked]:ring-purple-200">
                                    <input type="radio" wire:model="payment_method" value="BCA"
                                        class="w-5 h-5">
                                    <div class="ml-3">
                                        <p class="font-semibold text-slate-900">Bank BCA</p>
                                        <p class="text-sm text-slate-600">1234567890 a.n BUMDes Sebauk</p>
                                    </div>
                                </label>
                                <label
                                    class="flex items-center p-3 border bg-white rounded-lg cursor-pointer has-[:checked]:border-green-500 has-[:checked]:ring-2 has-[:checked]:ring-purple-200">
                                    <input type="radio" wire:model="payment_method" value="Mandiri"
                                        class="w-5 h-5">
                                    <div class="ml-3">
                                        <p class="font-semibold text-slate-900">Bank Mandiri</p>
                                        <p class="text-sm text-slate-600">0987654321 a.n BUMDes Sebauk</p>
                                    </div>
                                </label>
                            </div>
                            @error('payment_method')
                                <span class="text-red-500 text-sm mt-1">{{ $message }}</span>
                            @enderror
                            <div class="mt-6">
                                <label class="block text-sm font-medium text-slate-900 mb-2">Upload Bukti
                                    Transfer</label>
                                <input type="file" wire:model="proof_of_transaction"
                                    class="block w-full text-sm file:mr-4 file:py-2 file:px-4 file:rounded-full file:border-0 file:text-sm file:font-semibold file:bg-purple-50 file:text-purple-700 hover:file:bg-purple-100">
                                @error('proof_of_transaction')
                                    <span class="text-red-500 text-sm">{{ $message }}</span>
                                @enderror
                                <div wire:loading wire:target="proof_of_transaction"
                                    class="text-sm text-gray-500 mt-1">Uploading...</div>
                            </div>
                        </div>
                        @auth
                            <button type="submit"
                                class="w-full mt-6 py-3 text-lg font-medium bg-green-500 text-white rounded-md hover:bg-green-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-purple-500 disabled:opacity-50"
                                wire:loading.attr="disabled">
                                <span wire:loading.remove wire:target="save">Konfirmasi & Buat Pesanan</span>
                                <span wire:loading wire:target="save">Memproses...</span>
                            </button>
                        @else
                            <a href="{{ route('login') }}" wire:navigate
                                class="block text-center w-full mt-6 py-3 text-lg font-medium bg-gray-300 text-gray-500 rounded-md cursor-not-allowed transition">
                                Login untuk Melanjutkan Pesanan
                            </a>
                        @endauth
                    </div>
                </div>
            </div>
        </form>
    </div>
</div>
