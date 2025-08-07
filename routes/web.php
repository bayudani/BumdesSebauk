<?php

use App\Livewire\Article\ArticleDetail;
use Illuminate\Support\Facades\Route;
use Stephenjude\FilamentBlog\Models\Post;

Route::view('/', 'home');

Route::view('dashboard', 'dashboard')
    ->middleware(['auth', 'verified'])
    ->name('dashboard');

Route::view('profile', 'profile')
    ->middleware(['auth'])
    ->name('profile');

Route::get('/blog/{post:slug}', ArticleDetail::class)->name('blog.show');


require __DIR__ . '/auth.php';
