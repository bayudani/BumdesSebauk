<?php

namespace App\Filament\Widgets;

use App\Models\Product;
use App\Models\Transaction;
use Filament\Widgets\StatsOverviewWidget as BaseWidget;
use Filament\Widgets\StatsOverviewWidget\Stat;
use Stephenjude\FilamentBlog\Models\Post;

class StatsOverview extends BaseWidget
{
    protected function getStats(): array
    {
        return [
            Stat::make('Total Produk', Product::count())
                ->description('Jumlah semua produk yang tersedia')
                ->descriptionIcon('heroicon-m-cube')
                ->color('success')
                ->url(route('filament.admin.resources.products.index')),

            Stat::make('Total Transaksi', Transaction::count())
                ->description('Jumlah Transaksi yang telah dilakukan')
                ->descriptionIcon('heroicon-s-currency-dollar')
                ->color('primary')
                ->url(route('filament.admin.resources.blog.posts.index')),

            Stat::make('Total Blog Post', Post::count())
                ->description('Jumlah artikel yang dipublikasikan')
                ->descriptionIcon('heroicon-m-document-text')
                ->color('info')
                ->url(route('filament.admin.resources.transactions.index')),

            Stat::make('Stok Habis', Product::where('stok', 0)->count())
                ->description('Produk yang sudah kosong')
                ->descriptionIcon('heroicon-m-exclamation-triangle')
                ->color('danger')
                ->url(route('filament.admin.resources.products.index')),


        ];
    }
}
