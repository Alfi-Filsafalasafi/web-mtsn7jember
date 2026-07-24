<?php

namespace App\Filament\Resources\LaporanZiResource\Pages;

use App\Filament\Resources\LaporanZiResource;
use Filament\Actions;
use Filament\Resources\Pages\CreateRecord;

class CreateLaporanZi extends CreateRecord
{
    protected static string $resource = LaporanZiResource::class;
    protected function getRedirectUrl(): string
    {
        return $this->getResource()::getUrl('index');
    }
}
