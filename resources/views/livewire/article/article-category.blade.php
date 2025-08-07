<div>
    <section id="for-you-entertainment" class="max-w-[1130px] mx-auto mt-[70px]">
        <div class="flex justify-between items-center">
            <h1 class="font-bold text-[26px] leading-[39px]">
                Terkait
                <br />
                Desa Sebauk
            </h1>
            {{-- <a href="{{ route('blog.index') }}">
                <div class="py-3 px-[22px] border border-[#EEF0F7] rounded-full font-semibold">Selengkapnya</div>
            </a> --}}
        </div>

        <div class="mt-[30px] max-h-[424px] flex justify-between">
            {{-- Featured Artikel (artikel pertama) --}}
            @if($articles->isNotEmpty())
                @php
                    $featured = $articles->first();
                    $featuredImage = $featured->banner 
                        ? \Illuminate\Support\Facades\Storage::url($featured->banner)
                        : asset('assets/images/default.jpg');
                @endphp

                <div class="relative overflow-hidden rounded-[20px] border max-w-[635px]">
                    <img src="{{ $featuredImage }}" alt="Gambar Artikel" class="w-full h-full object-cover" />
                    <div class="absolute inset-0 bg-[linear-gradient(180deg,rgba(0,0,0,0)_0%,rgba(0,0,0,0.9)_100%)]"></div>
                    <div class="text-white space-y-[10px] absolute bottom-[30px] left-[30px]">
                        <p>Featured</p>
                        <a href="{{ route('blog.show', $featured->slug) }}">
                            <h1 class="font-bold text-[30px] leading-9 hover:underline pr-[30px]">
                                {{ $featured->title }}
                            </h1>
                        </a>
                    </div>
                </div>
            @endif

            {{-- List Artikel lainnya --}}
            <div class="relative" id="custom-scrollbar">
                <div class="max-w-[475px] space-y-[20px] pr-4 max-h-[424px] overflow-auto" id="custom-scrollbar">
                    @foreach($articles->skip(1) as $article)
                        @php
                            $thumb = $article->banner 
                                ? \Illuminate\Support\Facades\Storage::url($article->banner)
                                : asset('assets/images/default.jpg');
                        @endphp
                        <a href="{{ route('blog.show', $article->slug) }}">
                            <div class="border border-[#EEF0F7] p-[14px] rounded-[20px] items-center flex space-x-4 hover:border-[#FF6B18] transition-all duration-300">
                                <div class="h-[100px] w-[130px] flex-shrink-0 rounded-[20px] overflow-hidden">
                                    <img src="{{ $thumb }}" alt="Thumbnail" class="h-full w-full object-cover" />
                                </div>
                                <div class="space-y-[6px] flex-1">
                                    <h1 class="text-lg leading-[27px] font-bold">{{ $article->title }}</h1>
                                    <p class="text-[#A3A6AE] text-sm">{{ $article->published_at->format('d M, Y') }}</p>
                                </div>
                            </div>
                        </a>
                    @endforeach
                </div>
            </div>
        </div>
    </section>
</div>
