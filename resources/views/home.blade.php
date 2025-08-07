<x-app-layout>

<section id="hero-section" class="relative w-full overflow-hidden flex mx-auto mt-[30px]">
            <div class="swiper-hero w-full">
                <div class="swiper-wrapper">
                    

                    <div class="swiper-slide relative">
                        <div class="w-full h-[550px] overflow-hidden shrink-0">
                            <img src="assets/images/kantor.png" class="w-full h-full object-cover object-top" alt="thumbnails" />
                        </div>
                        <div class="absolute inset-0 bg-gradient-to-t from-black/90 to-transparent"></div>
                        <div class="absolute flex bottom-0 left-0 right-0 items-center justify-between mx-auto max-w-[1280px] px-[75px] pb-[40px]">
                            <div class="flex flex-col gap-[10px] text-white">
                                <div class="w-[507px]">
                                    <a href="#" class="font-bold text-[36px] leading-[45px] hover:underline transition-all duration-300">Selamat Datang di Website Resmi BUMDes Sebauk</a>
                                   
                                </div>
                                <p> Business</p>
                            </div>
                            
                        </div>
                    </div>
                </div>
            </div>
            
        </section>
        <livewire:about.aboud-bumdes/>
         <livewire:article.article-new/> 
         <livewire:article.article-category/> 

    <script src="https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.js"></script>
    <script src="js/swipe.js"></script>
    <div class="flex items-center gap-1">

        <div class="h-[18px] w-[18px] shrink-0 overflow-hidden">
            <img class="h-full w-full object-contain" src="assets/images/icons/message-question-gray.svg"
                alt="" />
        </div>
    </div>
    </section>



</x-app-layout>
