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

    // group
    protected static ?string $navigationGroup = 'Transactions';

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
                    ->numeric()
                    ->maxLength(20),
                Forms\Components\Select::make('status')
                    ->options([
                        'pending' => 'Pending',
                        'completed' => 'Completed',
                        'cancelled' => 'Cancelled', 
                    ])                  
                    ->required(),               
                Forms\Components\TextInput::make('payment_method')
                    ->nullable()
                    ->maxLength(255),
                Forms\Components\FileUpload::make('proof of transaction')
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
                // Table columns for the Transaction resource
                Tables\Columns\TextColumn::make('product.name')
                    ->label('Product Name')
                    ->sortable()
                    ->searchable(),
                Tables\Columns\TextColumn::make('customer_name')
                    ->label('Customer Name')
                    ->sortable()
                    ->searchable(),
                Tables\Columns\TextColumn::make('customer_address')
                    ->label('Customer Address')
                    ->limit(50)
                    ->sortable()
                    ->searchable(),
                Tables\Columns\TextColumn::make('customer_phone')
                    ->label('Customer Phone')
                    ->sortable()
                    ->searchable(),
                Tables\Columns\TextColumn::make('product.category.name')
                    ->label('Category')
                    ->sortable()
                    ->searchable(),
                Tables\Columns\ImageColumn::make('product.image')
                    ->label('Product Image'),
                Tables\Columns\TextColumn::make('quantity')
                    ->sortable(),
                Tables\Columns\TextColumn::make('total_amount')
                    ->sortable(),
                Tables\Columns\TextColumn::make('status')
                    ->sortable(),
                Tables\Columns\TextColumn::make('transaction_date')
                    ->dateTime()
                    ->sortable(),
                Tables\Columns\TextColumn::make('payment_method')
                    ->sortable(),
                Tables\Columns\ImageColumn::make('proof of transaction')
                    ->label('Proof of Transaction')
                    ->sortable(),
                Tables\Columns\TextColumn::make('created_at')
                    ->dateTime()
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
                Tables\Actions\EditAction::make(),
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
