<?php

namespace App\Livewire\Article;

use Livewire\Component;
use Stephenjude\FilamentBlog\Models\Post;
use Livewire\Attributes\Layout;
use Illuminate\Support\Str;

/**
 * This component uses the layout file at `resources/views/layouts/app.blade.php`.
 * Make sure that file exists and includes your CSS/JS assets and a `{{ $slot }}` placeholder.
 */
#[Layout('layouts.app')]
class ArticleDetail extends Component
{
    /**
     * The main post object, automatically injected by Laravel's route model binding.
     *
     * @var Post
     */
    public Post $post;

    /**
     * A collection of other articles from the same author.
     */
    public $authorArticles;

    /**
     * A collection of other random/recent articles.
     */
    public $otherArticles;

    /**
     * Mount the component.
     * Laravel's Route Model Binding automatically finds the Post model based on the slug in the URL
     * and injects it into this method.
     *
     * Your route in `routes/web.php` should look like this:
     * Route::get('/blog/{post:slug}', ArticleDetail::class)->name('blog.show');
     *
     * @param Post $post The post model instance.
     */
    public function mount(Post $post)
    {
        $this->post = $post;
        $this->loadRelatedArticles();
    }

    /**
     * Fetches related articles to display on the page.
     * This includes more articles from the same author and other suggested news.
     */
    public function loadRelatedArticles()
    {
        // Fetch up to 3 other published articles from the same author, excluding the current one.
        if ($this->post->author) {
            $this->authorArticles = Post::where('blog_author_id', $this->post->blog_author_id)
                ->where('id', '!=', $this->post->id) // Exclude the current post
                ->whereNotNull('published_at')
                ->whereDate('published_at', '<=', now())
                ->latest('published_at')
                ->take(3)
                ->get();
        } else {
            $this->authorArticles = collect(); // Return an empty collection if no author
        }


        // Fetch 3 other published articles, excluding the current one, to show as "Other News".
        $this->otherArticles = Post::where('id', '!=', $this->post->id)
            ->whereNotNull('published_at')
            ->whereDate('published_at', '<=', now())
            ->latest('published_at')
            ->take(3)
            ->get();
    }

    /**
     * Render the component's view.
     *
     * @return \Illuminate\View\View
     */
    public function render()
    {
        // The layout is already defined by the `#[Layout('layouts.app')]` attribute above.
        return view('livewire.article.article-detail');
    }
}
