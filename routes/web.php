<?php

use App\Livewire\Article\ArticleDetail;
use App\Livewire\Product\Transactions;
use Illuminate\Support\Facades\Route;
use Stephenjude\FilamentBlog\Models\Post;

Route::view('/', 'home')->name('home');
Route::view('/berita', 'article')->name('articles');
Route::get('/checkout/{uuid}', \App\Livewire\Product\Transactions::class)
    ->name('checkout');
Route::view('/product', 'product')->name('product');
    // ->name('articles')
    // ->middleware(['auth', 'verified']);

Route::view('dashboard', 'dashboard')
    ->middleware(['auth', 'verified'])
    ->name('dashboard');

Route::view('profile', 'profile')
    ->middleware(['auth'])
    ->name('profile');

Route::get('/blog/{post:slug}', ArticleDetail::class)->name('blog.show');


require __DIR__ . '/auth.php';
