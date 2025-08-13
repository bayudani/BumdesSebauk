<?php

namespace App\Filament\Resources\StructureBumdesResource\Pages;

use App\Filament\Resources\StructureBumdesResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;

class ListStructureBumdes extends ListRecords
{
    protected static string $resource = StructureBumdesResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }
}
