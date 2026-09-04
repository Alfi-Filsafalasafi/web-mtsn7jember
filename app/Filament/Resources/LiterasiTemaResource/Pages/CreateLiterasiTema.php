<?php

namespace App\Filament\Resources\LiterasiTemaResource\Pages;

use App\Filament\Resources\LiterasiTemaResource;
use Filament\Resources\Pages\CreateRecord;

class CreateLiterasiTema extends CreateRecord
{
    protected static string $resource = LiterasiTemaResource::class;

    protected function getRedirectUrl(): string
    {
        return $this->getResource()::getUrl('index');
    }
}