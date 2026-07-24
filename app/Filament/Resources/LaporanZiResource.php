<?php

namespace App\Filament\Resources;

use App\Filament\Resources\LaporanZiResource\Pages;
use App\Models\LaporanZi;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;

class LaporanZiResource extends Resource
{
    protected static ?string $model = LaporanZi::class;
    protected static ?string $navigationIcon = 'heroicon-o-document-text';
    protected static ?string $navigationLabel = 'Laporan-Laporan';
    protected static ?string $pluralModelLabel = 'Laporan-Laporan ZI';
    protected static ?string $navigationGroup = 'Zona Integritas';
    protected static ?int $navigationSort = 2;

    public static function form(Form $form): Form
    {
        return $form->schema([
            Forms\Components\Section::make('Data Laporan')
                ->schema([
                    Forms\Components\TextInput::make('title')
                        ->label('Judul Laporan')
                        ->required()
                        ->maxLength(255)
                        ->placeholder('Laporan Capaian Kinerja Triwulan I Tahun 2023'),

                    Forms\Components\DatePicker::make('published_at')
                        ->label('Tanggal Terbit')
                        ->native(false)
                        ->displayFormat('d M Y')
                        ->default(now()),

                    Forms\Components\Textarea::make('description')
                        ->label('Deskripsi')
                        ->required()
                        ->rows(3)
                        ->columnSpanFull(),

                    Forms\Components\TextInput::make('sort_order')
                        ->label('Urutan Tampil')
                        ->numeric()
                        ->default(0)
                        ->helperText('Angka kecil tampil lebih dulu'),
                ])->columns(2),

            Forms\Components\Section::make('Logo & File')
                ->schema([
                    Forms\Components\FileUpload::make('logo')
                        ->label('Logo')
                        ->image()
                        ->directory('laporan-zi/logos')
                        ->imageResizeMode('cover')
                        ->imageCropAspectRatio('1:1')
                        ->nullable(),

                    Forms\Components\FileUpload::make('file')
                        ->label('File Laporan (PDF)')
                        ->required()
                        ->acceptedFileTypes(['application/pdf'])
                        ->directory('laporan-zi/files')
                        ->maxSize(10240) // 10MB
                        ->helperText('Maksimal 10MB, format PDF'),
                ])->columns(2),
        ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\ImageColumn::make('logo')
                    ->label('Logo')
                    ->width(50)
                    ->height(50)
                    ->defaultImageUrl(asset('images/no-photo.png')),

                Tables\Columns\TextColumn::make('title')
                    ->label('Judul')
                    ->searchable()
                    ->sortable()
                    ->limit(40),

                Tables\Columns\TextColumn::make('description')
                    ->label('Deskripsi')
                    ->limit(50)
                    ->tooltip(fn($record) => $record->description),

                Tables\Columns\TextColumn::make('file')
                    ->label('File')
                    ->url(fn($record) => asset('storage/' . $record->file))
                    ->openUrlInNewTab()
                    ->formatStateUsing(fn() => 'Lihat PDF')
                    ->icon('heroicon-o-document-arrow-down'),

                Tables\Columns\TextColumn::make('published_at')
                    ->label('Tanggal Terbit')
                    ->date('d M Y')
                    ->sortable(),

                Tables\Columns\TextColumn::make('sort_order')
                    ->label('Urutan')
                    ->sortable(),
            ])
            ->actions([
                Tables\Actions\EditAction::make(),
                Tables\Actions\DeleteAction::make(),
            ])
            ->bulkActions([
                Tables\Actions\BulkActionGroup::make([
                    Tables\Actions\DeleteBulkAction::make(),
                ]),
            ])
            ->defaultSort('sort_order', 'asc');
    }

    public static function getPages(): array
    {
        return [
            'index'  => Pages\ListLaporanZis::route('/'),
            'create' => Pages\CreateLaporanZi::route('/create'),
            'edit'   => Pages\EditLaporanZi::route('/{record}/edit'),
        ];
    }
}
