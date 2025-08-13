<?php

namespace App\Filament\Resources\StructureBumdesResource\Pages;

use App\Filament\Resources\StructureBumdesResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditStructureBumdes extends EditRecord
{
    protected static string $resource = StructureBumdesResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\DeleteAction::make(),
        ];
    }
}
