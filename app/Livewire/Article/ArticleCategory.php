<?php

namespace App\Livewire\Article;

use Livewire\Component;
use Stephenjude\FilamentBlog\Models\Post;

class ArticleCategory extends Component
{


    public function render()
    {

        $articles = Post::whereNotNull('published_at') // pastikan tanggal publish ada
            ->whereDate('published_at', '<=', now())   // ambil yang sudah dipublish
            ->orderBy('published_at', 'desc')          // urutkan dari yang terbaru
            ->take(4)                                   // ambil 3 artikel
            ->get();

        return view('livewire.article.article-category', [
            'articles' => $articles,
        ]);
    }
}
