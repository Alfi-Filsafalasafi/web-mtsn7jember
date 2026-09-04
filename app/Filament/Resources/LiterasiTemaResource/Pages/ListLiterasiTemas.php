<?php

namespace App\Filament\Resources\LiterasiTemaResource\Pages;

use App\Filament\Resources\LiterasiTemaResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;

class ListLiterasiTemas extends ListRecords
{
    protected static string $resource = LiterasiTemaResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }
}
