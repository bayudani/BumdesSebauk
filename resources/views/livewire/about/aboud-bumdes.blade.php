<div>
    <!-- Pastikan Swiper CSS & JS sudah di-include di layout utama atau di sini -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.css" />
    <script src="https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.js"></script>

    <div class="bg-[#fefcf9] py-16">
        <div class="max-w-5xl mx-auto px-4">

            <div class="swiper mySwiper">
                <div class="swiper-wrapper">

                    {{-- [INI BAGIAN DINAMISNYA] Looping data pejabat dari database --}}
                    @forelse ($officials as $official)
                        <div class="swiper-slide">
                            <div class="flex flex-col md:flex-row items-center justify-center gap-12">
                                <div class="flex-shrink-0">
                                    {{-- Tampilkan gambar dari database, dengan fallback jika kosong --}}
                                    <img src="{{ $official->photo ? asset('storage/' . $official->photo) : 'https://placehold.co/320x420/e2e8f0/334155?text=Foto' }}"
                                        alt="{{ $official->name }}"
                                        class="w-[320px] h-[420px] object-cover rounded shadow-md">
                                </div>
                                <div class="text-left">
                                    {{-- Tampilkan jabatan --}}
                                    <p class="text-sm uppercase tracking-widest text-gray-500 mb-2">{{ $official->position }}</p>
                                    {{-- Tampilkan nama --}}
                                    <h3 class="text-3xl font-semibold text-gray-900 mb-2">{{ $official->name }}</h3>
                                    {{-- Tampilkan sub-jabatan atau deskripsi singkat --}}
                                    <p class="text-lg text-gray-700 mb-4">{{ $official->position }} Sebauk</p>
                                    {{-- Tampilkan sambutan/quote dari database --}}
                                    <p class="text-gray-700 leading-relaxed">
                                        "{{ $official->description ?? 'Selamat datang di website kami. Mari bersama-sama membangun desa yang lebih maju dan sejahtera.' }}"
                                    </p>
                                </div>
                            </div>
                        </div>
                    @empty
                        {{-- Tampilan jika tidak ada data pejabat di database --}}
                        <div class="swiper-slide">
                            <div class="text-center py-12">
                                <p class="text-gray-500">Data pejabat tidak ditemukan.</p>
                            </div>
                        </div>
                    @endforelse

                </div>

                <!-- Tombol Next & Prev Custom -->
                <div class="swiper-button-next !w-10 !h-10 !bg-white/60 hover:!bg-white/80 transition !rounded-full !shadow-lg after:!text-gray-700 after:!text-lg"></div>
                <div class="swiper-button-prev !w-10 !h-10 !bg-white/60 hover:!bg-white/80 transition !rounded-full !shadow-lg after:!text-gray-700 after:!text-lg"></div>

                <div class="swiper-pagination"></div>
            </div>
        </div>
    </div>

    <script>
        // Inisialisasi Swiper
        new Swiper(".mySwiper", {
            loop: true,
            pagination: {
                el: ".swiper-pagination",
                clickable: true,
            },
            navigation: {
                nextEl: ".swiper-button-next",
                prevEl: ".swiper-button-prev",
            },
        });
    </script>
</div>
