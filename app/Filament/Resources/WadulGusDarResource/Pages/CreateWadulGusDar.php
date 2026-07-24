<?php

namespace App\Filament\Resources\WadulGusDarResource\Pages;

use App\Filament\Resources\WadulGusDarResource;
use Filament\Actions;
use Filament\Resources\Pages\CreateRecord;

class CreateWadulGusDar extends CreateRecord
{
    protected static string $resource = WadulGusDarResource::class;
    protected function getRedirectUrl(): string
    {
        return $this->getResource()::getUrl('index');
    }
}
