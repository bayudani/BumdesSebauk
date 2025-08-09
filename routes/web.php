<?php

use App\Livewire\Article\ArticleDetail;
use App\Livewire\Product\Tracking;
use App\Livewire\Product\Transactions;
use Illuminate\Support\Facades\Route;
use Stephenjude\FilamentBlog\Models\Post;

Route::view('/', 'home')->name('home');
Route::view('/berita', 'article')->name('articles');
Route::view('/product', 'product')->name('product');

Route::get('/track/{id?}', Tracking::class)->name('tracking');



// Route::view('/track', 'tracking')->name('track');
// ->name('articles')
// ->middleware(['auth', 'verified']);

Route::view('/riwayat', 'history')->name('history')
    ->middleware(['auth', 'verified']);

Route::get('/checkout/{id}', \App\Livewire\Product\Transactions::class)
    ->name('checkout')
    ->middleware(['auth', 'verified']);

Route::view('dashboard', 'dashboard')
    ->middleware(['auth', 'verified'])
    ->name('dashboard');

Route::view('profile', 'profile')
    ->middleware(['auth'])
    ->name('profile');

Route::get('/blog/{post:slug}', ArticleDetail::class)->name('blog.show');


require __DIR__ . '/auth.php';
