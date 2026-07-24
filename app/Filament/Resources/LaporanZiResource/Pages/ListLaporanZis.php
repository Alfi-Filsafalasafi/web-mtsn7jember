<?php

namespace App\Filament\Resources\LaporanZiResource\Pages;

use App\Filament\Resources\LaporanZiResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;

class ListLaporanZis extends ListRecords
{
    protected static string $resource = LaporanZiResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }
}
