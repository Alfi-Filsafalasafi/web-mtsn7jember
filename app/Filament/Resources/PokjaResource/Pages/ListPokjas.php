<?php

namespace App\Filament\Resources\PokjaResource\Pages;

use App\Filament\Resources\PokjaResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;

class ListPokjas extends ListRecords
{
    protected static string $resource = PokjaResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }
}
