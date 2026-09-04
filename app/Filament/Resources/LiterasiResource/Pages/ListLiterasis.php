<?php

namespace App\Filament\Resources\LiterasiResource\Pages;

use App\Filament\Resources\LiterasiResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;

class ListLiterasis extends ListRecords
{
    protected static string $resource = LiterasiResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }
}
