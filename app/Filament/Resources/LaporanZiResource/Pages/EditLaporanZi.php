<?php

namespace App\Filament\Resources\LaporanZiResource\Pages;

use App\Filament\Resources\LaporanZiResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditLaporanZi extends EditRecord
{
    protected static string $resource = LaporanZiResource::class;

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
