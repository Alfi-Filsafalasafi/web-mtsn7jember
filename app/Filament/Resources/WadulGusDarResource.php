<?php

namespace App\Filament\Resources;

use App\Filament\Resources\WadulGusDarResource\Pages;
use App\Models\WadulGusDar;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Notifications\Notification;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;

class WadulGusDarResource extends Resource
{
    protected static ?string $model = WadulGusDar::class;
    protected static ?string $navigationIcon = 'heroicon-o-chat-bubble-left-right';
    protected static ?string $navigationLabel = 'Wadul Gus Dar';
    protected static ?string $pluralModelLabel = 'Wadul Gus Dar';
    protected static ?int $navigationSort = 1;

    public static function getNavigationBadge(): ?string
    {
        return static::getModel()::where('status', 'baru')->count() ?: null;
    }

    public static function getNavigationBadgeColor(): ?string
    {
        return 'danger';
    }

    public static function form(Form $form): Form
    {
        return $form->schema([
            Forms\Components\Section::make('Data Wadul')
                ->schema([
                    Forms\Components\Select::make('type')
                        ->label('Jenis Wadul')
                        ->options([
                            'pengaduan' => 'Pengaduan',
                            'curhat'    => 'Curhat',
                            'saran'     => 'Saran',
                        ])
                        ->disabled(),

                    Forms\Components\Select::make('pengisi_role')
                        ->label('Peran Pengisi')
                        ->options([
                            'siswa'      => 'Siswa',
                            'guru'       => 'Guru',
                            'wali_murid' => 'Wali Murid',
                            'masyarakat' => 'Masyarakat',
                        ])
                        ->disabled(),

                    Forms\Components\Toggle::make('is_anonymous')
                        ->label('Anonim')
                        ->disabled(),

                    Forms\Components\TextInput::make('name')
                        ->label('Nama')
                        ->placeholder('Anonim')
                        ->disabled(),

                    Forms\Components\TextInput::make('phone')
                        ->label('No. HP / Kontak')
                        ->placeholder('-')
                        ->disabled(),

                    Forms\Components\Textarea::make('message')
                        ->label('Keterangan')
                        ->rows(5)
                        ->disabled()
                        ->columnSpanFull(),

                    Forms\Components\FileUpload::make('attachment')
                        ->label('Lampiran Foto')
                        ->image()
                        ->disabled()
                        ->columnSpanFull(),
                ])->columns(2),

            Forms\Components\Section::make('Tindak Lanjut')
                ->schema([
                    Forms\Components\Select::make('status')
                        ->label('Status')
                        ->options([
                            'baru'     => 'Baru',
                            'diproses' => 'Diproses',
                            'selesai'  => 'Selesai',
                        ])
                        ->required(),

                    Forms\Components\Textarea::make('response')
                        ->label('Catatan Tindak Lanjut')
                        ->rows(4)
                        ->columnSpanFull(),
                ])->columns(2),
        ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\ImageColumn::make('attachment')
                    ->label('Lampiran')
                    ->width(60)
                    ->height(60)
                    ->defaultImageUrl(asset('images/no-photo.png')),

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

                Tables\Columns\TextColumn::make('pengisi_role')
                    ->label('Peran')
                    ->formatStateUsing(fn(string $state): string => match ($state) {
                        'siswa'      => 'Siswa',
                        'guru'       => 'Guru',
                        'wali_murid' => 'Wali Murid',
                        'masyarakat' => 'Masyarakat',
                        default      => $state,
                    }),

                Tables\Columns\TextColumn::make('name')
                    ->label('Nama')
                    ->formatStateUsing(fn($state, $record) => $record->is_anonymous || empty($state) ? 'Anonim' : $state)
                    ->searchable(),

                Tables\Columns\TextColumn::make('phone')
                    ->label('No. HP')
                    ->placeholder('-'),

                Tables\Columns\TextColumn::make('message')
                    ->label('Keterangan')
                    ->limit(50)
                    ->tooltip(fn($record) => $record->message),

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
                    ->label('Tanggal Masuk')
                    ->dateTime('d M Y, H:i')
                    ->sortable(),
            ])
            ->filters([
                Tables\Filters\SelectFilter::make('type')
                    ->label('Jenis Wadul')
                    ->options([
                        'pengaduan' => 'Pengaduan',
                        'curhat'    => 'Curhat',
                        'saran'     => 'Saran',
                    ]),

                Tables\Filters\SelectFilter::make('status')
                    ->label('Status')
                    ->options([
                        'baru'     => 'Baru',
                        'diproses' => 'Diproses',
                        'selesai'  => 'Selesai',
                    ]),
            ])
            ->defaultSort('created_at', 'desc')
            ->actions([
                Tables\Actions\Action::make('tandai_selesai')
                    ->label('Tandai Selesai')
                    ->icon('heroicon-o-check-circle')
                    ->color('success')
                    ->visible(fn(WadulGusDar $record) => $record->status !== 'selesai')
                    ->requiresConfirmation()
                    ->modalHeading('Tandai wadul ini selesai?')
                    ->modalDescription('Status akan diubah menjadi "Selesai" dan tidak akan muncul lagi di badge notifikasi.')
                    ->action(function (WadulGusDar $record) {
                        $record->update([
                            'status'       => 'selesai',
                            'responded_at' => now(),
                        ]);

                        Notification::make()
                            ->title('Wadul ditandai selesai')
                            ->success()
                            ->send();
                    }),

                Tables\Actions\ViewAction::make(),
                Tables\Actions\EditAction::make(),
                Tables\Actions\DeleteAction::make(),
            ])
            ->bulkActions([
                Tables\Actions\BulkActionGroup::make([
                    Tables\Actions\DeleteBulkAction::make(),
                ]),
            ]);
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListWadulGusDars::route('/'),
            'edit'  => Pages\EditWadulGusDar::route('/{record}/edit'),
        ];
    }

    // Data hanya diisi lewat form publik, jadi tombol "New" di admin disembunyikan
    public static function canCreate(): bool
    {
        return false;
    }
}
