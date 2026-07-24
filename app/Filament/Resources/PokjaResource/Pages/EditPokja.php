<?php

namespace App\Filament\Resources\PokjaResource\Pages;

use App\Filament\Resources\PokjaResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditPokja extends EditRecord
{
    protected static string $resource = PokjaResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\DeleteAction::make(),
        ];
    }
}
