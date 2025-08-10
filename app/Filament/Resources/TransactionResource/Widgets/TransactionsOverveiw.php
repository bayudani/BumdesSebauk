<?php

namespace App\Filament\Resources\TransactionResource\Widgets;

use App\Models\Transaction;
use Filament\Widgets\StatsOverviewWidget as BaseWidget;
use Filament\Widgets\StatsOverviewWidget\Stat;

class TransactionsOverveiw extends BaseWidget
{
    protected function getStats(): array
    {
        return [
            Stat::make(
                'Total Transaksi',
                'Rp ' . number_format(
                    Transaction::where('transaction_status', 'completed')->sum('total_amount'),
                    0,
                    ',',
                    '.'
                )
            )
                ->description('Total nominal transaksi yang telah selesai')
                ->descriptionIcon('heroicon-s-currency-dollar')
                ->color('primary'),
                // ->url(route('filament.admin.resources.transactions.index')),

            Stat::make('Total Transaksi', Transaction::count())
                ->description('Jumlah Transaksi yang telah dilakukan')
                ->descriptionIcon('heroicon-s-currency-dollar')
                ->color('primary'),
                // ->url(route('filament.admin.resources.blog.posts.index')),
            
            Stat::make('Transaksi Selesai', Transaction::where('transaction_status', 'completed')->count())
                ->description('Jumlah Transaksi yang telah selesai')
                ->descriptionIcon('heroicon-s-currency-dollar')
                ->color('success')
                // ->url(route('filament.admin.resources.blog.posts.index')),

        ];
    }
}
