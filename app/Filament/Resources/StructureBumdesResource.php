<?php

namespace App\Filament\Resources;

use App\Filament\Resources\StructureBumdesResource\Pages;
use App\Filament\Resources\StructureBumdesResource\RelationManagers;
use App\Models\structure_bumdes;
use App\Models\StructureBumdes;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class StructureBumdesResource extends Resource
{
    protected static ?string $model = structure_bumdes::class;

    protected static ?string $navigationIcon = 'heroicon-s-users';

    protected static ?string $navigationLabel = 'Struktur Bumdes';
    protected static ?string $navigationGroup = 'Operasional';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                //name
                Forms\Components\TextInput::make('name')
                    ->required()
                    ->maxLength(255)
                    ->label('Name'),
                // position
                Forms\Components\TextInput::make('position')
                    ->required()
                    ->maxLength(255)
                    ->label('Position'),
                // photo
                Forms\Components\FileUpload::make('photo')
                    ->label('Photo')
                    ->required(),
                // description
                Forms\Components\TextInput::make('description')
                    ->nullable()
                    ->maxLength(500)
                    ->label('Description'),
                // email
                Forms\Components\TextInput::make('email')
                    ->nullable()
                    ->maxLength(255)
                    ->label('Email'),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                // name
                Tables\Columns\TextColumn::make('name')
                    ->label('Name')
                    ->searchable()
                    ->sortable(),
                // position
                Tables\Columns\TextColumn::make('position')
                    ->label('Position')
                    ->searchable()
                    ->sortable(),
                // email
                Tables\Columns\TextColumn::make('email')
                    ->label('Email')
                    ->searchable()
                    ->sortable(),
                // created_at
                Tables\Columns\TextColumn::make('created_at')
                    ->label('Created At')
                    ->dateTime()
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
            'index' => Pages\ListStructureBumdes::route('/'),
            'create' => Pages\CreateStructureBumdes::route('/create'),
            'edit' => Pages\EditStructureBumdes::route('/{record}/edit'),
        ];
    }
}
