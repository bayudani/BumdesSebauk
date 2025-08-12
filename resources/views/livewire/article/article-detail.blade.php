<div>
    {{-- HEADER --}}
    <section id="Header" class="max-w-[770px] w-full px-4 text-center mx-auto flex flex-col gap-y-4">
        <p class="text-[#A3A6AE] text-sm sm:text-base">
            {{ optional($post->published_at)->format('d M, Y') ?? '-' }} •
            {{ $post->category->name ?? 'Uncategorized' }}
        </p>
        <h1 class="font-bold text-2xl sm:text-4xl lg:text-[46px] leading-snug sm:leading-[50px] lg:leading-[60px]">
            {{ $post->title }}
        </h1>
        <div class="flex flex-col sm:flex-row items-center justify-center gap-y-4 sm:gap-x-[70px]">
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
        </div>
    </section>

    {{-- HERO PHOTO --}}
    @if ($post->banner)
        <section id="HeroPhoto" class="w-full mt-[30px] sm:mt-[50px]">
            <div class="aspect-[16/9] w-full overflow-hidden">
                <img src="{{ \Illuminate\Support\Facades\Storage::url($post->banner) }}" alt="image"
                    class="object-cover w-full h-full" />
            </div>
        </section>
    @endif

    {{-- MAIN CONTAINER --}}
    <section id="ContainerArticle" class="max-w-[1130px] w-full px-4 mx-auto flex flex-col lg:flex-row gap-10 mt-[30px] sm:mt-[50px]">
        <article class="flex-1">
            {!! $post->content !!}
        </article>

        <div class="side-bar flex flex-col w-full lg:w-[300px] shrink-0 gap-10">
            {{-- ADS / More From Author bisa ditaruh di sini --}}
        </div>
    </section>

    {{-- OTHER NEWS --}}
    <section id="OtherNewsYou" class="mx-auto mt-[50px] sm:mt-[70px] w-full bg-[#F9F9FC] px-4">
        <div class="flex flex-col mx-auto items-center gap-[30px] py-[40px] sm:py-[50px] max-w-[1130px]">
            <div class="flex flex-col sm:flex-row w-full items-start sm:items-center justify-between gap-4">
                <h1 class="w-full sm:w-[260px] text-balance text-xl sm:text-[26px] font-bold">
                    Other News You Might Be Interested
                </h1>
                <div class="max-h-[37px] max-w-[117px] rounded-full bg-[#FFECE1]">
                    <p class="px-[18px] py-2 text-center text-xs sm:text-sm font-bold text-maga-orange">UP TO DATE</p>
                </div>
            </div>
            <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-5 sm:gap-[30px] w-full">
                @foreach ($otherArticles as $news)
                    <a href="{{ route('blog.show', $news->slug) }}">
                        <div
                            class="flex bg-white flex-col gap-4 rounded-[20px] px-4 sm:px-5 py-[20px] sm:py-[26px] ring-1 ring-[#E8EBF4] transition-all duration-300 hover:ring-2 hover:ring-maga-orange">
                            <div class="relative flex">
                                <div
                                    class="absolute left-4 sm:left-5 top-4 sm:top-5 flex max-h-[34px] w-fit items-center justify-center rounded-full bg-white px-[14px] sm:px-[18px] py-1.5 sm:py-2">
                                    <span
                                        class="text-center text-[10px] sm:text-xs font-bold">{{ strtoupper($news->category?->name ?? 'NEWS') }}</span>
                                </div>
                                <div class="aspect-[16/10] w-full overflow-hidden rounded-[20px]">
                                    <img class="h-full w-full object-cover" src="{{ \Illuminate\Support\Facades\Storage::url($news->banner) }}"
                                        alt="" />
                                </div>
                            </div>
                            <div class="flex flex-col gap-[6px]">
                                <h2 class="text-balance text-base sm:text-lg font-bold">{{ $news->title }}</h2>
                                <p class="text-xs sm:text-sm text-[#A3A6AE]">
                                    {{ optional($news->published_at)->format('d M, Y') ?? '-' }}</p>
                            </div>
                        </div>
                    </a>
                @endforeach
            </div>
        </div>
    </section>
</div>
