<?php

namespace App\Filament\Resources\SurveiResource\Pages;

use App\Filament\Resources\SurveiResource;
use Filament\Resources\Pages\CreateRecord;

class CreateSurvei extends CreateRecord
{
    protected static string $resource = SurveiResource::class;
    protected function getRedirectUrl(): string
    {
        return $this->getResource()::getUrl('index');
    }
}
