<?php

namespace App\Filament\Resources;

use App\Filament\Resources\TransactionResource\Pages;
use App\Filament\Resources\TransactionResource\RelationManagers;
use App\Models\Transaction;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class TransactionResource extends Resource
{
    protected static ?string $model = Transaction::class;

    protected static ?string $navigationIcon = 'heroicon-s-currency-dollar';

    protected static ?string $navigationLabel = 'Transactions';
    // group
    protected static ?string $navigationGroup = 'Transactions';

    public static function getEloquentQuery(): Builder
    {
        return parent::getEloquentQuery()
            ->with('product');
    }
    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                // Form fields for the Transaction resource
                Forms\Components\Select::make('product_id')
                    ->relationship('product', 'name')
                    ->required(),
                Forms\Components\TextInput::make('customer_name')
                    ->required()
                    ->maxLength(255),
                Forms\Components\TextInput::make('customer_address')
                    ->nullable()
                    ->maxLength(255),
                Forms\Components\TextInput::make('customer_phone')
                    ->nullable()
                    ->maxLength(255),
                Forms\Components\TextInput::make('quantity')
                    ->default(1)
                    ->numeric()
                    ->required(),
                Forms\Components\TextInput::make('total_amount')
                    ->required()
                    ->numeric(),
                    // ->maxLength(20),
                Forms\Components\Select::make('transaction_status')
                    ->options([
                        'pending' => 'Pending',
                        'completed' => 'Completed',
                        'cancelled' => 'Cancelled',
                    ])
                    ->required(),
                Forms\Components\Select::make('order_status')
                    ->options([
                        'pending' => 'Pending',
                        'processing' => 'processing',
                        'completed' => 'Completed',
                        'cancelled' => 'Cancelled',
                    ])
                    ->required(),
                Forms\Components\TextInput::make('payment_method')
                    ->nullable()
                    ->maxLength(255),
                Forms\Components\FileUpload::make('proof_of_transaction')
                    ->nullable()
                    ->image()
                    ->maxSize(1024)
                    ->disk('public'),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('product.name')
                    ->label('Product Name')
                    ->sortable()
                    ->searchable(),

                Tables\Columns\TextColumn::make('customer_name')
                    ->label('Customer Name')
                    ->sortable()
                    ->searchable(),

                Tables\Columns\TextColumn::make('total_amount')
                    ->sortable(),

                Tables\Columns\TextColumn::make('order_status')
                    ->sortable(),

                Tables\Columns\TextColumn::make('transaction_status')
                    ->sortable(),
            ])
            ->filters([
                // filter by product
                Tables\Filters\SelectFilter::make('product')
                    ->relationship('product', 'name')
                    ->multiple(),
                // by date
                Tables\Filters\SelectFilter::make('transaction_date')
                    ->label('Transaction Date'),
            ])
            ->actions([
                Tables\Actions\ViewAction::make(), // ini untuk detail
                Tables\Actions\EditAction::make(),
                Tables\Actions\DeleteAction::make(),
                Tables\Actions\Action::make('markAsCompleted')
                    ->label('Konfirmasi pembayaran')
                    ->icon('heroicon-s-check-circle')
                    ->color('success')
                    ->modalHeading('Konfirmasi Pembayaran')
                    ->modalSubheading('Yakin ingin konfirmasi pembayaran ini? Tindakan ini tidak dapat dibatalkan.')
                    ->modalButton('Ya, Konfirmasi')
                    ->requiresConfirmation()
                    ->visible(fn($record) => $record->transaction_status !== 'completed') // tampil cuma kalau belum completed
                    ->action(function ($record) {
                        $record->update([
                            'transaction_status' => 'completed',
                            'order_status' => 'processing', // <-- Tambahkan baris ini
                        ]);
                    }),
            ])
            ->bulkActions([
                Tables\Actions\BulkActionGroup::make([
                    Tables\Actions\DeleteBulkAction::make(),
                ]),
            ]);
    }

    public static function getRelations(): array
    {
        return [
            //
        ];
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListTransactions::route('/'),
            'create' => Pages\CreateTransaction::route('/create'),
            'edit' => Pages\EditTransaction::route('/{record}/edit'),
        ];
    }
}
