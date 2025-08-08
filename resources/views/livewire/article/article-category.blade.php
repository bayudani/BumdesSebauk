<div>
     <!-- Article Section (Mobile-Friendly) -->
    <section id="for-you-entertainment" class="max-w-[1130px] mx-auto py-16 md:py-24 px-4">
        <div class="flex flex-col md:flex-row justify-between items-start md:items-center">
            <h1 class="font-bold text-2xl md:text-3xl leading-tight">
                Berita Terbaru
                <br />
                Desa Sebauk
            </h1>
            <a href="{{ route('articles') }}" class="mt-4 md:mt-0 py-3 px-6 border border-gray-300 rounded-full font-semibold text-sm hover:bg-gray-100 transition-all">
                Lihat Semua Berita
            </a>
        </div>

        <div class="mt-8 md:mt-12 flex flex-col lg:flex-row gap-8">
            {{-- Featured Artikel (artikel pertama) --}}
            @if(isset($articles) && $articles->isNotEmpty())
                @php
                    $featured = $articles->first();
                    $featuredImage = $featured->banner 
                        ? \Illuminate\Support\Facades\Storage::url($featured->banner)
                        : asset('assets/images/default.jpg');
                @endphp

                <!-- Kolom Kiri: Featured Artikel -->
                <div class="w-full lg:w-7/12">
                    <a href="{{ route('blog.show', $featured->first()->slug) }}" class="block relative overflow-hidden rounded-2xl group h-full min-h-[400px]">
                        <img src="{{ $featuredImage }}" alt="Gambar Artikel" class="w-full h-full object-cover group-hover:scale-105 transition-transform duration-300" />
                        <div class="absolute inset-0 bg-gradient-to-t from-black/80 to-transparent"></div>
                        <div class="absolute bottom-0 left-0 p-6 text-white">
                            <span class="text-sm bg-purple-600 px-2 py-1 rounded">Featured</span>
                            <h3 class="font-bold text-2xl leading-tight mt-2 group-hover:underline">
                                {{ $featured->title }}
                            </h3>
                        </div>
                    </a>
                </div>

                <!-- Kolom Kanan: List Artikel Lainnya -->
                <div class="w-full lg:w-5/12 flex flex-col gap-5">
                    @foreach($articles->skip(1)->take(3) as $article)
                        @php
                            $thumb = $article->banner 
                                ? \Illuminate\Support\Facades\Storage::url($article->banner)
                                : asset('assets/images/default.jpg');
                        @endphp
                        <a href="{{ route('blog.show', $articles->first()->slug) }}" class="flex items-center gap-4 p-4 border border-gray-200 rounded-2xl bg-white hover:shadow-lg hover:border-purple-500 transition-all duration-300">
                            <div class="w-24 h-24 md:w-28 md:h-28 flex-shrink-0 rounded-xl overflow-hidden">
                                <img src="{{ $thumb }}" alt="Thumbnail" class="w-full h-full object-cover" />
                            </div>
                            <div class="flex-1">
                                <h4 class="text-base leading-snug font-bold mb-1">{{ $article->title }}</h4>
                                <p class="text-gray-500 text-xs">{{ $article->published_at->format('d M, Y') }}</p>
                            </div>
                        </a>
                    @endforeach
                </div>
            @else
                 <p class="text-center text-gray-500 w-full py-10">Belum ada berita untuk ditampilkan.</p>
            @endif
        </div>
    </section>
</div>
