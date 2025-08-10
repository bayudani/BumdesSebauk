<?php

use Illuminate\Support\Facades\Route;
use App\Livewire\Product\Transactions as Checkout;
use App\Livewire\Product\Tracking;
use App\Livewire\Article\ArticleDetail;
// use App\Livewire\Profile\HistoryTransaction; // Asumsi dari history

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
*/

// == GRUP RUTE PUBLIK (Bisa diakses semua orang) ==
Route::view('/', 'home')->name('home');
Route::view('/product', 'product')->name('product');
Route::view('/berita', 'article')->name('articles');
Route::get('/blog/{post:slug}', ArticleDetail::class)->name('blog.show');
Route::get('/track/{id?}', Tracking::class)->name('tracking');
Route::view('/tentang-kami', 'about')->name('about'); // Disesuaikan URL-nya
Route::get('/checkout/{id}', \App\Livewire\Product\Transactions::class)->name('checkout');


// == GRUP RUTE TERPROTEKSI (Wajib Login) ==
Route::middleware(['auth'])->group(function () {
    
    // Rute yang hanya butuh login
    Route::view('profile', 'profile')->name('profile');

    // Rute yang butuh login DAN verifikasi email

        Route::view('dashboard', 'dashboard')->name('dashboard');
        Route::view('/riwayat', 'history')->name('history'); 
    });




// Rute untuk otentikasi (login, register, dll)
require __DIR__ . '/auth.php';