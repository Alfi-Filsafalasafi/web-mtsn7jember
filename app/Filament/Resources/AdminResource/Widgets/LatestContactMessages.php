<?php

namespace App\Filament\Widgets;

use App\Models\ContactMessage;
use Filament\Tables;
use Filament\Tables\Table;
use Filament\Widgets\TableWidget as BaseWidget;
use Illuminate\Support\Facades\Route as RouteFacade;

class LatestContactMessages extends BaseWidget
{
    protected static ?string $heading = 'Pesan Kontak Terbaru';

    protected int | string | array $columnSpan = 'full';

    protected static ?int $sort = 3;

    protected function detailUrl(ContactMessage $record): ?string
    {
        if (RouteFacade::has('filament.admin.resources.contact-messages.view')) {
            return route('filament.admin.resources.contact-messages.view', $record);
        }

        if (RouteFacade::has('filament.admin.resources.contact-messages.edit')) {
            return route('filament.admin.resources.contact-messages.edit', $record);
        }

        return null;
    }

    public function table(Table $table): Table
    {
        return $table
            ->query(
                ContactMessage::query()->latest()->limit(5)
            )
            ->columns([
                Tables\Columns\IconColumn::make('is_read')
                    ->label('Dibaca')
                    ->boolean(),

                Tables\Columns\TextColumn::make('name')
                    ->label('Nama'),

                Tables\Columns\TextColumn::make('email')
                    ->label('Email'),

                Tables\Columns\TextColumn::make('message')
                    ->label('Pesan')
                    ->limit(50),

                Tables\Columns\TextColumn::make('created_at')
                    ->label('Masuk')
                    ->since(),
            ])
            ->actions([
                Tables\Actions\Action::make('lihat')
                    ->label('Lihat')
                    ->icon('heroicon-m-eye')
                    ->url(fn(ContactMessage $record) => $this->detailUrl($record))
                    ->visible(fn(ContactMessage $record) => filled($this->detailUrl($record))),
            ])
            ->paginated(false);
    }
}
