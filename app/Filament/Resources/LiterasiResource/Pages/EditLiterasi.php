<?php

namespace App\Filament\Resources\LiterasiResource\Pages;

use App\Filament\Resources\LiterasiResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditLiterasi extends EditRecord
{
    protected static string $resource = LiterasiResource::class;

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