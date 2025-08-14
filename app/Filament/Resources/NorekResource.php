<?php

namespace App\Filament\Resources;

use App\Filament\Resources\NorekResource\Pages;
use App\Filament\Resources\NorekResource\RelationManagers;
use App\Models\Norek;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class NorekResource extends Resource
{
    protected static ?string $model = Norek::class;

    protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';
    protected static ?string $navigationGroup = 'Operasional';
    

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                // name_bank
                Forms\Components\TextInput::make('nama_bank')
                    ->required()
                    ->maxLength(255),
                // no_rekening
                Forms\Components\TextInput::make('no_rekening')
                    ->required()
                    ->maxLength(255)
                    ->unique(ignoreRecord: true),
                // atas_nama
                Forms\Components\TextInput::make('atas_nama')
                    ->required()
                    ->maxLength(255),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                // name_bank
                Tables\Columns\TextColumn::make('nama_bank')
                    ->label('Nama Bank')
                    ->searchable()
                    ->sortable(),
                // no_rekening
                Tables\Columns\TextColumn::make('norek')
                    ->label('No Rekening')
                    ->searchable()
                    ->sortable(),
                // atas_nama
                Tables\Columns\TextColumn::make('atas_nama')
                    ->label('Atas Nama')
                    ->searchable()
                    ->sortable(),
            ])
            ->filters([
                //
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
            'index' => Pages\ListNoreks::route('/'),
            'create' => Pages\CreateNorek::route('/create'),
            'edit' => Pages\EditNorek::route('/{record}/edit'),
        ];
    }
}
