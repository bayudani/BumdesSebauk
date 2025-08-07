<?php

namespace App\Livewire\Article;

use Livewire\Component;
use Stephenjude\FilamentBlog\Models\Post;

class Article extends Component
{
    public function render()
    {
        $articles = Post::whereNotNull('published_at')
            ->whereDate('published_at', '<=', now())
            ->latest()
            ->paginate(10);

            $popularArticles = Post::orderByDesc('click_count')
            ->whereNotNull('published_at')
            ->whereDate('published_at', '<=', now())
            ->take(5)
            ->get();

        return view('livewire.article.article', [
            'articles' => $articles,
            'popularArticles' => $popularArticles,
        ]);
    }
}
