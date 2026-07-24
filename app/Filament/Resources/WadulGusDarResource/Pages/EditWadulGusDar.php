<?php

namespace App\Filament\Resources\WadulGusDarResource\Pages;

use App\Filament\Resources\WadulGusDarResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditWadulGusDar extends EditRecord
{
    protected static string $resource = WadulGusDarResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\DeleteAction::make(),
        ];
    }
    protected function getRedirectUrl(): string
    {
        return $this->getResource()::getUrl('index');
    }
}
