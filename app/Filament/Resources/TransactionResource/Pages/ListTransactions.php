<?php

namespace App\Filament\Resources\TransactionResource\Pages;

use App\Filament\Resources\TransactionResource;
use App\Filament\Resources\TransactionResource\Widgets\TransactionsOverveiw;
// use Barryvdh\DomPDF\Facade\Pdf;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;
use Barryvdh\DomPDF\Facade\Pdf;


class ListTransactions extends ListRecords
{
    protected static string $resource = TransactionResource::class;

    protected function getHeaderActions(): array
    {
        return [
            // Actions\CreateAction::make(),

            // Tombol Export PDF kita
            Actions\Action::make('export_pdf')
                ->label('Export PDF')
                ->color('danger')
                ->icon('heroicon-s-arrow-down-tray')
                ->action(function () {
                    // Ambil data sesuai dengan filter yang sedang aktif di tabel
                    $records = $this->getFilteredTableQuery()->get();

                    // Buat PDF dari view, dan kirim data transaksi ke view tersebut
                    $pdf = Pdf::loadView('pdf.transactions', ['transactions' => $records]);

                    // Kirim PDF ke browser untuk di-download
                    return response()->streamDownload(function () use ($pdf) {
                        echo $pdf->stream();
                    }, 'laporan-transaksi-' . date('Y-m-d') . '.pdf');
                }),
        ];
    }
    protected function getHeaderWidgets(): array
    {
        return [
            TransactionsOverveiw::class,
        ];
    }
}
