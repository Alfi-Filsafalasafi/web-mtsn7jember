<?php

namespace App\Filament\Resources\LiterasiPasswordResource\Pages;

use App\Filament\Resources\LiterasiPasswordResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;

class ListLiterasiPasswords extends ListRecords
{
    protected static string $resource = LiterasiPasswordResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }
}
