<div>
    <div class="p-4 bg-white">
        <div class="max-w-screen-xl mx-auto">

            @if (session()->has('message'))
                <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded relative mb-6"
                    role="alert">
                    <span class="block sm:inline">{{ session('message') }}</span>
                </div>
            @endif

            <div class="border-b border-gray-300 pb-4">
                <div class="flex items-center gap-4">
                    <h3 class="text-2xl font-semibold text-slate-900">Riwayat Pesanan</h3>
                    <div class="ml-auto">
                        <select wire:model.live="filterStatus"
                            class="appearance-none cursor-pointer bg-gray-100 hover:bg-gray-200 border border-gray-300 outline-0 px-4 py-2 rounded-md text-[15px]">
                            <option value="all">Semua Pesanan</option>
                            <option value="completed">Selesai</option>
                            <option value="processing">Diproses</option>
                            <option value="pending">Menunggu</option>
                            <option value="cancelled">Dibatalkan</option>
                        </select>
                    </div>
                </div>
            </div>

            <div class="divide-y divide-gray-300 mt-4">
                @forelse ($transactions as $transaction)
                    <div
                        class="grid grid-cols-2 md:grid-cols-3 lg:grid-cols-5 items-center justify-between gap-x-4 gap-y-6 py-4">
                        <div>
                            <h6 class="text-[15px] font-medium text-slate-900">{{ $transaction->product->name }}</h6>
                            <div class="mt-2">
                                <p class="text-[15px] text-slate-500 font-medium">Order ID:
                                    <span class="ml-1 text-slate-900">#{{ substr($transaction->transaction_code, 0, 8) }}...</span>
                                </p>
                            </div>
                        </div>
                        <div>
                            <h6 class="text-[15px] font-medium text-slate-500">Tanggal</h6>
                            <p class="text-[15px] text-slate-900 font-medium mt-2">
                                {{ $transaction->created_at->format('d M Y') }}</p>
                        </div>
                        <div>
                            <h6 class="text-[15px] font-medium text-slate-500">Status</h6>
                            @php
                                $statusClass = '';
                                switch ($transaction->order_status) {
                                    case 'completed':
                                        $statusClass = 'bg-green-100 text-green-600';
                                        break;
                                    case 'processing':
                                        $statusClass = 'bg-blue-100 text-blue-600';
                                        break;
                                    case 'cancelled':
                                        $statusClass = 'bg-red-100 text-red-600';
                                        break;
                                    default:
                                        // pending
                                        $statusClass = 'bg-yellow-100 text-yellow-600';
                                        break;
                                }
                            @endphp
                            <p
                                class="text-[13px] font-medium mt-2 inline-block rounded-md py-1.5 px-3 {{ $statusClass }}">
                                <span class="capitalize">{{ $transaction->order_status }}</span>
                            </p>
                        </div>
                        <div>
                            <h6 class="text-[15px] font-medium text-slate-500">Harga</h6>
                            <p class="text-[15px] text-slate-900 font-medium mt-2">Rp
                                {{ number_format($transaction->total_amount, 0, ',', '.') }}</p>
                        </div>
                        <div class="flex md:flex-wrap gap-4 lg:justify-end max-md:col-span-full">

                            @if ($transaction->order_status == 'processing')
                                <button type="button" wire:click="confirmOrder('{{ $transaction->id }}')"
                                    wire:confirm="Anda yakin pesanan ini sudah diterima dan ingin menyelesaikannya?"
                                    class="text-[15px] font-medium px-4 py-2 rounded-md bg-green-600 hover:bg-green-700 text-white tracking-wide cursor-pointer w-full md:w-auto">
                                    Pesanan Diterima
                                </button>
                            @endif

                            <a href="{{ route('tracking', ['id' => $transaction->transaction_code]) }}" wire:navigate
                                class="text-center text-[15px] font-medium px-4 py-2 rounded-md bg-gray-100 hover:bg-gray-200 text-slate-900 tracking-wide cursor-pointer w-full md:w-auto">
                                Lihat Detail
                            </a>
                        </div>
                    </div>
                @empty
                    <div class="text-center py-16">
                        <p class="text-slate-500">Anda belum memiliki riwayat transaksi.</p>
                        <a href="{{ route('product') }}" wire:navigate
                            class="mt-4 inline-block text-[15px] font-medium px-6 py-2 rounded-md bg-green-500 hover:bg-green-700 text-white tracking-wide">
                            Mulai Belanja
                        </a>
                    </div>
                @endforelse

                <div class="mt-8">
                    {{ $transactions->links() }}
                </div>
            </div>
        </div>
    </div>
</div>
