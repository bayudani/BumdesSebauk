<x-app-layout>

    <!-- Hero Section -->
    <section id="hero-section" class="relative w-full overflow-hidden">
        <div class="swiper-hero w-full">
            <div class="swiper-wrapper">
                <!-- Slide 1 -->
                <div class="swiper-slide relative">
                    <!-- Hero Image -->
                    <div class="w-full h-[300px] md:h-[550px] overflow-hidden shrink-0">
                        <img src="{{ asset('assets/images/kantor.png') }}" 
                             class="w-full h-full object-cover object-top" 
                             alt="thumbnails" />
                    </div>

                    <!-- Gradient Overlay -->
                    <div class="absolute inset-0 bg-gradient-to-t from-black/90 to-transparent"></div>

                    <!-- Hero Text -->
                    <div class="absolute flex flex-col md:flex-row bottom-0 left-0 right-0 items-start md:items-center justify-between mx-auto max-w-[1280px] px-4 md:px-[75px] pb-[20px] md:pb-[40px]">
                        <div class="flex flex-col gap-[10px] text-white">
                            <div class="w-full md:w-[507px]">
                                <a href="#" 
                                   class="font-bold text-[20px] md:text-[36px] leading-[28px] md:leading-[45px] hover:underline transition-all duration-300">
                                   Selamat Datang di Website Resmi BUMDes Sebauk
                                </a>
                            </div>
                            {{-- <p class="text-sm md:text-base">Business</p> --}}
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- About Section -->
    <livewire:about.aboud-bumdes/>

    <!-- Article Category -->
    <livewire:article.article-category/> 

    <!-- Swiper Scripts -->
    <script src="https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.js"></script>
    <script>
        const swiperHero = new Swiper('.swiper-hero', {
            loop: true,
            autoplay: {
                delay: 4000,
                disableOnInteraction: false,
            },
            speed: 800,
            effect: 'fade',
        });
    </script>

    <!-- Icon -->
   

</x-app-layout>
