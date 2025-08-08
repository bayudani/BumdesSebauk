<div>
    <div class="bg-white p-4">
        <div class="md:max-w-5xl max-w-xl mx-auto">
            <div class="grid md:grid-cols-2 lg:grid-cols-3 gap-8">
                <div class="lg:col-span-2 max-md:order-1">
                    <h2 class="text-3xl font-semibold text-slate-900">Make a payment</h2>
                    <p class="text-slate-500 text-sm mt-4">
                        Silakan transfer ke salah satu rekening berikut, lalu upload bukti transfer.
                    </p>

                    <div class="mt-8 max-w-lg">
                        <h3 class="text-lg font-semibold text-slate-900">Pilih Rekening Tujuan</h3>
                        <div class="flex flex-col gap-4 mt-6">

                            <!-- Bank 1 -->
                            <label
                                class="flex items-center p-4 border rounded-lg cursor-pointer hover:border-purple-500">
                                <input type="radio" name="bank" class="w-5 h-5" checked>
                                <div class="ml-4">
                                    <p class="font-semibold text-slate-900">Bank BCA</p>
                                    <p class="text-sm text-slate-600">No. Rekening: 1234567890</p>
                                    <p class="text-sm text-slate-600">a.n PT Contoh Sukses Makmur</p>
                                </div>
                            </label>

                            <!-- Bank 2 -->
                            <label
                                class="flex items-center p-4 border rounded-lg cursor-pointer hover:border-purple-500">
                                <input type="radio" name="bank" class="w-5 h-5">
                                <div class="ml-4">
                                    <p class="font-semibold text-slate-900">Bank Mandiri</p>
                                    <p class="text-sm text-slate-600">No. Rekening: 9876543210</p>
                                    <p class="text-sm text-slate-600">a.n PT Contoh Sukses Makmur</p>
                                </div>
                            </label>

                            <!-- Bank 3 -->
                            <label
                                class="flex items-center p-4 border rounded-lg cursor-pointer hover:border-purple-500">
                                <input type="radio" name="bank" class="w-5 h-5">
                                <div class="ml-4">
                                    <p class="font-semibold text-slate-900">Bank BNI</p>
                                    <p class="text-sm text-slate-600">No. Rekening: 555666777</p>
                                    <p class="text-sm text-slate-600">a.n PT Contoh Sukses Makmur</p>
                                </div>
                            </label>
                        </div>

                        <!-- Upload Bukti Transfer -->
                        <form class="mt-8 space-y-4">
                            <div>
                                <label class="block text-sm font-medium text-slate-900 mb-2">
                                    Upload Bukti Transfer
                                </label>
                                <input type="file" accept="image/*"
                                    class="block w-full text-sm text-gray-900 border border-gray-200 rounded-md cursor-pointer bg-gray-50 focus:outline-none focus:border-purple-500">
                            </div>

                            <button type="submit"
                                class="w-40 py-3 text-[15px] font-medium bg-purple-500 text-white rounded-md hover:bg-purple-600 tracking-wide">
                                Kirim
                            </button>
                        </form>
                    </div>
                </div>

                <!-- Ringkasan Pembayaran -->
                <div class="bg-gray-100 p-6 rounded-md">
                    <h2 class="text-2xl font-semibold text-slate-900">Rp 3.500.000</h2>
                    <ul class="text-slate-500 font-medium mt-8 space-y-4">
                        <li class="flex flex-wrap gap-4 text-sm">Paket Wedding Gold <span
                                class="ml-auto font-semibold text-slate-900">Rp 3.400.000</span></li>
                        <li class="flex flex-wrap gap-4 text-sm">Tax <span
                                class="ml-auto font-semibold text-slate-900">Rp 100.000</span></li>
                        <li
                            class="flex flex-wrap gap-4 text-[15px] font-semibold text-slate-900 border-t border-gray-300 pt-4">
                            Total <span class="ml-auto">Rp 3.500.000</span></li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
</div>
