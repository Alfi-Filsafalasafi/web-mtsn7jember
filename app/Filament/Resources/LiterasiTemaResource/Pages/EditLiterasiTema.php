<?php

namespace App\Filament\Resources\LiterasiTemaResource\Pages;

use App\Filament\Resources\LiterasiTemaResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditLiterasiTema extends EditRecord
{
    protected static string $resource = LiterasiTemaResource::class;

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