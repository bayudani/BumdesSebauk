<div>
    <div class="max-w-7xl mx-auto px-4 py-8">
        <div class="grid grid-cols-1 lg:grid-cols-3 gap-8">
            <!-- Main Content -->
            <div class="lg:col-span-2">
                <!-- Section Header -->
                <div class="mb-6">
                    <h1 class="text-2xl font-bold text-gray-900 border-l-4 border-red-600 pl-4">Artikel Terbaru</h1>
                </div>

                <!-- Hero Article -->
                @if ($articles->count())
                    @php
                        $hero = $articles->first();
                    @endphp

                    <a href="{{ route('blog.show', $hero->slug) }}">
                        <article class="relative mb-8 rounded-lg overflow-hidden shadow-lg">
                            <img src="{{ $hero->banner ? Storage::url($hero->banner) : asset('assets/images/default.jpg') }}"
                                alt="{{ $hero->title }}" class="w-full h-80 object-cover">
                            <div class="absolute inset-0 bg-black bg-opacity-40"></div>
                            <div class="absolute bottom-0 left-0 right-0 p-6 text-white">
                                <h2 class="text-3xl font-bold mb-3 leading-tight">{{ $hero->title }}</h2>
                                <p class="text-gray-200 mb-3 line-clamp-2">
                                    {{ Str::limit(strip_tags($hero->content), 100) }}</p>
                                <span class="inline-block bg-red-600 text-white px-3 py-1 text-sm font-medium rounded">
                                    {{ $hero->category?->name ?? 'Uncategorized' }}
                                </span>
                            </div>
                        </article>
                    </a>

                    <div class="mb-6">
                        <h1 class="text-2xl font-bold text-gray-900 border-l-4 border-red-600 pl-4">Semua artikel</h1>
                    </div>
                    <!-- Article Cards Grid -->
                    <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
                        @foreach ($articles->skip(1) as $article)
                            <a href="{{ route('blog.show', $article->slug) }}" <article
                                class="bg-white rounded-lg shadow-md overflow-hidden">
                                <img src="{{ $article->banner ? Storage::url($article->banner) : asset('assets/images/default.jpg') }}"
                                    alt="{{ $article->title }}" class="w-full h-48 object-cover">
                                <div class="p-4">
                                    <h3 class="font-bold text-gray-900 mb-2 leading-tight">{{ $article->title }}</h3>
                                    <p class="text-gray-600 text-sm line-clamp-2">
                                        {{ Str::limit(strip_tags($article->content), 100) }}</p>
                                </div>
                                </article>
                            </a>
                        @endforeach
                    </div>

                    <!-- Pagination -->
                    <div class="mt-8">
                        {{ $articles->links() }}
                    </div>
                @else
                    <p class="text-gray-600">Belum ada artikel yang tersedia.</p>
                @endif
            </div>

            <!-- Sidebar -->
            <div class="lg:col-span-1">
                <!-- Most Popular Section -->
                <!-- Most Popular Section -->
<div class="bg-white rounded-lg shadow-md p-6 mb-6">
    <h2 class="text-xl font-bold text-gray-900 mb-6">Most Popular</h2>
    <div class="space-y-4">
        @foreach ($popularArticles as $index => $pop)
            <div class="flex items-start space-x-4">
                <span class="text-3xl font-bold text-gray-300">{{ $index + 1 }}</span>
                <div>
                    <a href="{{ route('blog.show', $pop->slug) }}">
                        <h3 class="font-semibold text-gray-900 leading-tight hover:underline">
                            {{ $pop->title }}
                        </h3>
                    </a>
                </div>
            </div>
        @endforeach
    </div>
</div>


                <!-- Advertisement Section -->
                <div class="bg-black rounded-lg p-8 text-center text-white">
                    <p class="text-sm text-gray-400 mb-4">ADVERTISEMENT</p>
                    <div class="mb-4">
                        <h3 class="text-2xl font-bold mb-2">ADVERTISEMENT</h3>
                        <p class="text-xl">300X250</p>
                    </div>
                    <button class="bg-gray-700 hover:bg-gray-600 text-white px-6 py-2 rounded transition-colors">
                        CONTACT US
                    </button>
                </div>
            </div>
        </div>
    </div>
</div>
