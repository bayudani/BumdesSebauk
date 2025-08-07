<?php

namespace App\Livewire\Article;

use Livewire\Component;
use Stephenjude\FilamentBlog\Models\Post;

class Article extends Component
{
    public function render()
    {
        // get all articles
        $articles = Post::latest()->paginate(10);
        // pass articles to the view
        return view('livewire.article.article', [
            'articles' => $articles,
        ]);
        // return view('livewire.article.article');
    }
}
