<div>
    <div class="max-w-7xl mx-auto px-4 py-8">
        <div class="grid grid-cols-1 lg:grid-cols-3 gap-8">
            <!-- Kiri -->
            <div class="lg:col-span-2 space-y-6">
                <!-- Hero Article -->
                <a href="{{ route('blog.show', $articles->first()->slug) }}">
                    <article class="relative rounded-lg overflow-hidden shadow-lg">
                        <img src="{{ $articles->first()->banner ? Storage::url($articles->first()->banner) : asset('assets/images/default.jpg') }}"
                             alt="{{ $articles->first()->title }}"
                             class="w-full h-80 object-cover">
                        <div class="absolute inset-0 bg-black bg-opacity-40"></div>
                        <div class="absolute bottom-0 left-0 right-0 p-6 text-white">
                            <h2 class="text-3xl font-bold mb-3 leading-tight">
                                {{ $articles->first()->title }}
                            </h2>
                            <p class="text-gray-200 mb-3 line-clamp-2">
                                {{ Str::limit(strip_tags($articles->first()->content), 100) }}
                            </p>
                            <span class="inline-block bg-red-600 text-white px-3 py-1 text-sm font-medium rounded">
                                {{ $articles->first()->category?->name ?? 'Uncategorized' }}
                            </span>
                        </div>
                    </article>
                </a>

                <!-- Semua Artikel -->
                <div>
                    <h1 class="text-2xl font-bold text-gray-900 border-l-4 border-red-600 pl-4 mb-4">Semua artikel</h1>
                    <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
                        @foreach ($articles->skip(1) as $article)
                            <a href="{{ route('blog.show', $article->slug) }}" 
                               class="bg-white rounded-lg shadow-md overflow-hidden">
                                <img src="{{ $article->banner ? Storage::url($article->banner) : asset('assets/images/default.jpg') }}"
                                     alt="{{ $article->title }}"
                                     class="w-full h-48 object-cover">
                                <div class="p-4">
                                    <h3 class="font-bold text-gray-900 mb-2 leading-tight">{{ $article->title }}</h3>
                                    <p class="text-gray-600 text-sm line-clamp-2">
                                        {{ Str::limit(strip_tags($article->content), 100) }}
                                    </p>
                                </div>
                            </a>
                        @endforeach
                    </div>
                </div>
            </div>

            <!-- Kanan -->
            <div class="lg:col-span-1 self-start">
                <div class="bg-white rounded-lg shadow-md p-6">
                    <h2 class="text-xl font-bold text-gray-900 mb-6">Most Popular</h2>
                    <div class="space-y-4">
                        @foreach ($popularArticles as $index => $pop)
                            <a href="{{ route('blog.show', $pop->slug) }}" 
                               class="flex items-center space-x-4 hover:shadow-md transition">
                                <img src="{{ $pop->banner ? Storage::url($pop->banner) : asset('assets/images/default.jpg') }}"
                                     alt="{{ $pop->title }}"
                                     class="w-20 h-20 object-cover rounded">
                                <div class="flex-1">
                                    <div class="flex items-center gap-2">
                                        <span class="text-lg font-bold text-red-600">{{ $index + 1 }}</span>
                                        <h3 class="font-semibold text-gray-900 leading-tight line-clamp-2">
                                            {{ $pop->title }}
                                        </h3>
                                    </div>
                                </div>
                            </a>
                        @endforeach
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
