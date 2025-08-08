<div>
    {{-- @section('content') --}}
    <div class="max-w-7xl mx-auto px-4 py-8">
        <h1 class="text-3xl font-bold mb-6">Produk Bumdes</h1>
        @php
            $categories = $products->groupBy('category'); // Asumsinya data produk sudah dikelompokkan
        @endphp

        @foreach ($categories as $categoryName => $items)
            <div class="mb-10">
                <div class="flex justify-between items-center mb-4">
                    {{-- <h2 class="text-xl font-semibold">{{ ucfirst($categoryName) }}</h2> --}}
                    <a href="#" class="text-sm text-blue-600 hover:underline">Lihat Semua</a>
                </div>
                <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-6">
                    @foreach ($items as $product)
                        <a href="{{ route('checkout', $product->id) }}"
                            class="block bg-white rounded-lg shadow p-4 hover:shadow-lg transition">
                            <img src="{{ asset('storage/' . $product->image) }}" alt="{{ $product->name }}"
                                class="w-full h-40 object-cover rounded mb-3">
                            <h3 class="text-lg font-semibold">{{ $product->name }}</h3>
                            <p class="text-sm text-gray-600">{{ Str::limit($product->description, 60) }}</p>
                            <div class="mt-3 text-green-600 font-bold">
                                Rp {{ number_format($product->price, 0, ',', '.') }}
                            </div>
                            <div class="text-sm text-gray-500 mt-1">Stok: {{ $product->stok }}</div>
                        </a>
                    @endforeach
                </div>
            </div>
        @endforeach
    </div>
    {{-- @endsection --}}
</div>