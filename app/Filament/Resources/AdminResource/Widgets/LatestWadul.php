<?php

namespace App\Filament\Widgets;

use App\Models\WadulGusDar;
use Filament\Tables;
use Filament\Tables\Table;
use Filament\Widgets\TableWidget as BaseWidget;
use Illuminate\Support\Facades\Route as RouteFacade;

class LatestWadul extends BaseWidget
{
    protected static ?string $heading = 'Wadul Gus Dar Terbaru';

    protected int | string | array $columnSpan = 'full';

    protected static ?int $sort = 2;

    /**
     * Cari route detail yang tersedia untuk record ini.
     * Coba 'view' dulu, kalau tidak ada pakai 'edit', kalau dua-duanya
     * tidak ada, kembalikan null (tombol otomatis disembunyikan).
     */
    protected function detailUrl(WadulGusDar $record): ?string
    {
        if (RouteFacade::has('filament.admin.resources.wadul-gus-dars.view')) {
            return route('filament.admin.resources.wadul-gus-dars.view', $record);
        }

        if (RouteFacade::has('filament.admin.resources.wadul-gus-dars.edit')) {
            return route('filament.admin.resources.wadul-gus-dars.edit', $record);
        }

        return null;
    }

    public function table(Table $table): Table
    {
        return $table
            ->query(
                WadulGusDar::query()->latest()->limit(5)
            )
            ->columns([
                Tables\Columns\BadgeColumn::make('type')
                    ->label('Jenis')
                    ->colors([
                        'danger'  => 'pengaduan',
                        'warning' => 'curhat',
                        'success' => 'saran',
                    ])
                    ->formatStateUsing(fn(string $state): string => match ($state) {
                        'pengaduan' => 'Pengaduan',
                        'curhat'    => 'Curhat',
                        'saran'     => 'Saran',
                        default     => $state,
                    }),

                Tables\Columns\TextColumn::make('name')
                    ->label('Nama')
                    ->formatStateUsing(fn($state, $record) => $record->is_anonymous || empty($state) ? 'Anonim' : $state),

                Tables\Columns\TextColumn::make('message')
                    ->label('Keterangan')
                    ->limit(50),

                Tables\Columns\BadgeColumn::make('status')
                    ->label('Status')
                    ->colors([
                        'danger'  => 'baru',
                        'warning' => 'diproses',
                        'success' => 'selesai',
                    ])
                    ->formatStateUsing(fn(string $state): string => match ($state) {
                        'baru'     => 'Baru',
                        'diproses' => 'Diproses',
                        'selesai'  => 'Selesai',
                        default    => $state,
                    }),

                Tables\Columns\TextColumn::make('created_at')
                    ->label('Masuk')
                    ->since(),
            ])
            ->actions([
                Tables\Actions\Action::make('lihat')
                    ->label('Lihat')
                    ->icon('heroicon-m-eye')
                    ->url(fn(WadulGusDar $record) => $this->detailUrl($record))
                    ->visible(fn(WadulGusDar $record) => filled($this->detailUrl($record))),
            ])
            ->paginated(false);
    }
}
