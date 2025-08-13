<?php

namespace App\Filament\Resources;

use App\Filament\Resources\ContactResource\Pages;
use App\Filament\Resources\ContactResource\RelationManagers;
use App\Models\Contact;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class ContactResource extends Resource
{
    protected static ?string $model = Contact::class;

    protected static ?string $navigationIcon = 'heroicon-c-device-phone-mobile';
    protected static ?string $navigationLabel = 'kontak';

    // group
    protected static ?string $navigationGroup = 'Operasional';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                // name
                Forms\Components\TextInput::make('name')
                    ->required()
                    ->maxLength(255)
                    ->label('Contact Name'),
                // no_hp
                Forms\Components\TextInput::make('no_hp')
                    ->required()
                    ->maxLength(20)
                    ->label('Phone Number')
                    ->tel()
                    // ->mask(fn (Forms\Components\TextInput\Mask $mask) => $mask->pattern('+62 0000-0000-0000')),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                // name
                Tables\Columns\TextColumn::make('name')
                    ->label('Contact Name')
                    ->searchable()
                    ->sortable(),
                // no_hp
                Tables\Columns\TextColumn::make('no_hp')
                    ->label('Phone Number')
                    ->searchable()
                    ->sortable(),
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
            'index' => Pages\ListContacts::route('/'),
            'create' => Pages\CreateContact::route('/create'),
            'edit' => Pages\EditContact::route('/{record}/edit'),
        ];
    }
}
