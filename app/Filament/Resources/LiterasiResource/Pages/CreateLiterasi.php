<?php

namespace App\Filament\Resources\LiterasiResource\Pages;

use App\Filament\Resources\LiterasiResource;
use Filament\Resources\Pages\CreateRecord;

class CreateLiterasi extends CreateRecord
{
    protected static string $resource = LiterasiResource::class;

    protected function getRedirectUrl(): string
    {
        return $this->getResource()::getUrl('index');
    }
}