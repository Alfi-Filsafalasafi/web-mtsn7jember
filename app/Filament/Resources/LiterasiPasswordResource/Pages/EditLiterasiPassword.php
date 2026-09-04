<?php

namespace App\Filament\Resources\LiterasiPasswordResource\Pages;

use App\Filament\Resources\LiterasiPasswordResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditLiterasiPassword extends EditRecord
{
    protected static string $resource = LiterasiPasswordResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\DeleteAction::make(),
        ];
    }
}
