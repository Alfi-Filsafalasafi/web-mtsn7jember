<?php

namespace App\Filament\Resources\WadulGusDarResource\Pages;

use App\Filament\Resources\WadulGusDarResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;

class ListWadulGusDars extends ListRecords
{
    protected static string $resource = WadulGusDarResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }
    protected function getRedirectUrl(): string
    {
        return $this->getResource()::getUrl('index');
    }
}
