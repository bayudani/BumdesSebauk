<div>
    {{-- HEADER --}}
    <section id="Header" class="w-[770px] text-center mx-auto flex flex-col gap-y-4">
        <p class="text-[#A3A6AE]">
            {{ optional($post->published_at)->format('d M, Y') ?? '-' }} •
            {{ $post->category->name ?? 'Uncategorized' }}
        </p>
        <h1 class="font-bold text-[46px] leading-[60px]">{{ $post->title }}</h1>
        <div class="flex items-center mx-auto gap-x-[70px]">
            <div class="flex gap-3 items-center">
                <div class="w-10 h-10 shrink-0 overflow-hidden flex justify-center items-center rounded-full">
                    <img src="https://blocks.astratic.com/img/general-img-landscape.png"
                        alt="image" class="object-cover w-full h-full" />
                </div>
                <div>
                    <h5 class="font-semibold text-start text-sm leading-[21px]">
                        {{ $post->author?->name ?? 'Unknown Author' }}</h5>
                    <p class="text-xs leading-[18px] text-[#A3A6AE]">{{ $post->author?->position ?? 'Author' }}</p>
                </div>
            </div>
            <div class="flex gap-1 items-center">
                <div class="flex gap-[1px] items-center">
                    {{-- @for ($i = 0; $i < 5; $i++)
                        <img src="{{ asset('assets/images/icons/star.svg') }}" alt="icon"
                            class="w-4 h-4 shrink-0" />
                    @endfor
                </div> --}}
                {{-- <strong class="font-semibold text-xs leading-[18px]">
                    ({{ number_format($post->author?->followers_count ?? 12490) }})
                </strong> --}}
            </div>
        </div>
    </section>

    {{-- HERO PHOTO --}}
    @if ($post->banner)
        <section id="HeroPhoto" class="h-[500px] flex justify-center items-center overflow-hidden w-full mt-[50px]">
            <img src="{{ \Illuminate\Support\Facades\Storage::url($post->banner) }}" alt="image" class="object-cover w-full h-full" />
        </section>
    @endif

    {{-- MAIN CONTAINER --}}
    <section id="ContainerArticle" class="max-w-[1130px] mx-auto flex gap-20 mt-[50px]">
        <article>
            {{-- Body Artikel --}}
            {!! $post->content !!}
        </article>

        <div class="side-bar flex flex-col w-[300px] shrink-0 gap-10">
            {{-- ADS --}}
            {{-- <div class="ads flex flex-col gap-3 w-full">
                <a href="#">
                    <div class="flex justify-center items-center overflow-hidden w-[300px] h-[300px] rounded-2xl">
                        <img src="https://blocks.astratic.com/img/general-img-landscape.png" alt="image"
                            class="object-cover w-full h-full" />
                    </div>
                </a>
                <div class="flex items-center gap-1">
                    <p class="font-medium text-sm leading-[21px] text-[#A3A6AE]">Our Advertisement</p>
                    <a href="#">
                        <img src="https://blocks.astratic.com/img/general-img-landscape.png" alt="icon"
                            class="w-[18px] h-[18px] shrink-0" />
                    </a>
                </div>
            </div> --}}

            {{-- More From Author --}}
            {{-- <div class="more-for-author flex flex-col gap-4">
                <p class="font-bold">More From Author</p>
                @forelse($authorArticles as $article)
                    <a href="{{ route('blog.show', $article->slug) }}" class="card">
                        <div
                            class="rounded-[20px] ring-1 ring-[#EEF0F7] p-[14px] flex gap-4 hover:ring-2 hover:ring-maga-orange transition-all duration-300">
                            <div
                                class="w-[70px] h-[70px] flex shrink-0 justify-center items-center overflow-hidden rounded-2xl">
                                <img src="https://blocks.astratic.com/img/general-img-landscape.png"
                                    alt="image" class="w-full h-full object-cover" />
                            </div>
                            <div class="flex flex-col gap-[6px]">
                                <p class="line-clamp-2 font-bold">{{ $article->title }}</p>
                                <p class="text-xs leading-[18px] text-[#A3A6AE]">
                                    {{ optional($article->published_at)->format('d M, Y') ?? '-' }} •
                                    {{ $article->category?->name ?? 'Entertainment' }}
                                </p>
                            </div>
                        </div>
                    </a>
                @empty
                    <p class="text-xs text-gray-400">No more articles from this author.</p>
                @endforelse
            </div> --}}

            {{-- ADS --}}
            {{-- <div class="ads flex flex-col gap-3 w-full">
                <a href="#">
                    <div class="flex justify-center items-center overflow-hidden w-[300px] h-[300px] rounded-2xl">
                        <img src="https://blocks.astratic.com/img/general-img-landscape.png" alt="image"
                            class="object-cover w-full h-full" />
                    </div>
                </a>
                <div class="flex items-center gap-1">
                    <p class="font-medium text-sm leading-[21px] text-[#A3A6AE]">Our Advertisement</p>
                    <a href="#">
                        <img src="https://blocks.astratic.com/img/general-img-landscape.png" alt="icon"
                            class="w-[18px] h-[18px] shrink-0" />
                    </a>
                </div>
            </div> --}}
        </div>
    </section>

    {{-- ADVERTISEMENT BANNER --}}
    {{-- <section id="Advertisement" class="mx-auto mt-[70px] flex max-h-[153px] w-full max-w-[900px] flex-col gap-3">
        <a href="">
            <div class="h-[120px] w-full overflow-hidden rounded-2xl">
                <img class="h-full w-full object-contain"
                    src="https://blocks.astratic.com/img/general-img-landscape.png" alt="" />
            </div>
        </a>
        <div class="flex items-center gap-1">
            <p class="text-sm font-[500px] text-[#A3A6AE]">Our Advertisement</p>
            <div class="h-[18px] w-[18px] shrink-0 overflow-hidden">
                <img class="h-full w-full object-contain"
                    src="https://blocks.astratic.com/img/general-img-landscape.png" alt="" />
            </div>
        </div>
    </section> --}}

    {{-- OTHER NEWS --}}
    <section id="OtherNewsYou" class="mx-auto mt-[70px] w-full bg-[#F9F9FC]">
        <div class="flex flex-col mx-auto items-center gap-[30px] py-[50px] max-w-[1130px]">
            <div class="flex w-full items-center justify-between">
                <h1 class="w-[260px] text-balance text-[26px] font-bold">Other News You Might Be Interested</h1>
                <div class="max-h-[37px] max-w-[117px] rounded-full bg-[#FFECE1]">
                    <p class="px-[18px] py-2 text-center text-sm font-bold text-maga-orange">UP TO DATE</p>
                </div>
            </div>
            <div class="grid max-h-[349px] w-full grid-cols-3 gap-[30px] focus:ring-maga-orange">
                @foreach ($otherArticles as $news)
                    <a href="{{ route('blog.show', $news->slug) }}">
                        <div
                            class="flex max-w-[357px] bg-white flex-col gap-4 rounded-[20px] px-5 py-[26px] ring-1 ring-[#E8EBF4] transition-all duration-300 hover:ring-2 hover:ring-maga-orange">
                            <div class="relative flex">
                                <div
                                    class="absolute left-5 top-5 flex max-h-[34px] w-fit items-center justify-center rounded-full bg-white px-[18px] py-2">
                                    <span
                                        class="text-center text-xs font-bold">{{ strtoupper($news->category?->name ?? 'NEWS') }}</span>
                                </div>
                                <div class="h-[200px] w-full overflow-hidden rounded-[20px]">
                                    <img class="h-full w-full object-cover" src="{{ \Illuminate\Support\Facades\Storage::url($news->banner) }}"
                                        alt="" />
                                </div>
                            </div>
                            <div class="flex max-h-[81px] w-full flex-col gap-[6px]">
                                <h2 class="text-balance text-lg font-bold">{{ $news->title }}</h2>
                                <p class="text-sm text-[#A3A6AE]">
                                    {{ optional($news->published_at)->format('d M, Y') ?? '-' }}</p>
                            </div>
                        </div>
                    </a>
                @endforeach
            </div>
        </div>
    </section>
</div>
