<!-- Pastikan Swiper CSS & JS sudah di-include -->
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.css" />
<script src="https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.js"></script>

<div class="bg-[#fefcf9] py-16">
  <div class="max-w-5xl mx-auto px-4">

    <div class="swiper mySwiper">
      <div class="swiper-wrapper">

        <!-- Slide 1 -->
        <div class="swiper-slide">
          <div class="flex flex-col md:flex-row items-center justify-center gap-12">
            <div class="flex-shrink-0">
              <img src="{{ asset('assets/images/kades.jpg') }}" alt="Kepala Desa"
                class="w-[320px] h-[420px] object-cover rounded shadow-md">
            </div>
            <div class="text-left">
              <p class="text-sm uppercase tracking-widest text-gray-500 mb-2">Kepala Desa</p>
              <h3 class="text-3xl font-semibold text-gray-900 mb-2">Tamrin</h3>
              <p class="text-lg text-gray-700 mb-4">Kepala Desa Sebauk</p>
              <p class="text-gray-700 leading-relaxed">
                "BUMDes merupakan salah satu pilar penting dalam mendorong pertumbuhan ekonomi desa.
                Saya mengajak seluruh masyarakat Desa Sebauk untuk mendukung pengelolaan BUMDes secara profesional,
                transparan, dan berkelanjutan..."
              </p>
            </div>
          </div>
        </div>

        <!-- Slide 2 -->
        <div class="swiper-slide">
          <div class="flex flex-col md:flex-row items-center justify-center gap-12">
            <div class="flex-shrink-0">
              <img src="{{ asset('assets/images/kades.jpg') }}" alt="Direktur Bumdes Sebauk"
                class="w-[320px] h-[420px] object-cover rounded shadow-md">
            </div>
            <div class="text-left">
              <p class="text-sm uppercase tracking-widest text-gray-500 mb-2">Direktur Bumdes Sebauk</p>
              <h3 class="text-3xl font-semibold text-gray-900 mb-2">Budi Santoso</h3>
              <p class="text-lg text-gray-700 mb-4"> Desa Sebauk</p>
              <p class="text-gray-700 leading-relaxed">
                "Mari kita bersama-sama membangun desa dengan semangat gotong royong
                dan menjaga kekompakan demi kemajuan bersama."
              </p>
            </div>
          </div>
        </div>

      </div>

      <!-- Tombol Next & Prev Custom -->
      <div class="swiper-button-next !w-10 !h-10 !bg-white/60 hover:!bg-white/80 transition !rounded-full !shadow-lg after:!text-gray-700 after:!text-lg"></div>
      <div class="swiper-button-prev !w-10 !h-10 !bg-white/60 hover:!bg-white/80 transition !rounded-full !shadow-lg after:!text-gray-700 after:!text-lg"></div>

      <div class="swiper-pagination"></div>
    </div>
  </div>
</div>

<script>
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
