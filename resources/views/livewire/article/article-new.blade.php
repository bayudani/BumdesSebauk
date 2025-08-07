<div>
    <section id="hot-news"
        class="mx-auto mt-[70px] flex w-full max-w-[1130px] flex-col items-center gap-[30px]">
        <div class="flex w-full items-center justify-between">
            <h1 class="text-balance text-[26px] font-bold">Lihat Berita Terkini</h1>
            <div class="rounded-full bg-[#FFECE1]">
                <p class="px-[18px] py-2 text-center text-sm font-bold text-maga-orange">UP TO DATE</p>
            </div>
        </div>
        <div class="grid w-full grid-cols-1 gap-[30px] md:grid-cols-2 lg:grid-cols-3">
            {{-- Loop through the articles collection --}}
            @forelse ($articles as $article)
                <a href="{{ route('blog.show', $article->slug) }}" class="block">
                    <div
                        class="flex h-full flex-col gap-4 rounded-[20px] p-5 ring-1 ring-[#E8EBF4] transition-all duration-300 hover:ring-2 hover:ring-maga-orange">
                        <div class="relative">
                            {{-- Display the category name --}}
                            @if ($article->category)
                                <div
                                    class="absolute left-5 top-5 flex w-fit items-center justify-center rounded-full bg-white px-[18px] py-2">
                                    <span class="text-center text-xs font-bold">{{ $article->category->name }}</span>
                                </div>
                            @endif

                            {{-- Display the article banner/image --}}
                            <div class="h-[200px] w-full overflow-hidden rounded-[20px]">
                                <img class="h-full w-full object-cover" 
                                     src="{{ \Illuminate\Support\Facades\Storage::url($article->banner) }}"
                                     onerror="this.onerror=null;this.src='https://placehold.co/600x400/FFECE1/424242?text=Image+Not+Found';"
                                     alt="{{ $article->title }}" />
                            </div>
                        </div>
                        <div class="flex flex-grow flex-col gap-[6px]">
                            {{-- Display the article title --}}
                            <h2 class="text-balance text-lg font-bold leading-tight">{{ $article->title }}</h2>
                            {{-- Display the formatted published date --}}
                            <p class="mt-auto text-sm text-[#A3A6AE]">
                                {{ $article->published_at->format('d M, Y') }}
                            </p>
                        </div>
                    </div>
                </a>
            @empty
                {{-- Show this message if there are no articles --}}
                <div class="col-span-3 text-center">
                    <p class="text-gray-500">Belum ada berita untuk ditampilkan.</p>
                </div>
            @endforelse
        </div>
    </section>
</div>
