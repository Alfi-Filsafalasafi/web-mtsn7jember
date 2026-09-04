<?php

namespace App\Filament\Resources;

use App\Filament\Resources\LiterasiTemaResource\Pages;
use App\Models\LiterasiTema;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;

class LiterasiTemaResource extends Resource
{
    protected static ?string $model = LiterasiTema::class;

    protected static ?string $navigationIcon = 'heroicon-o-calendar-days';

    protected static ?string $navigationGroup = 'Literasi';

    protected static ?string $navigationLabel = 'Tema Bulanan';

    protected static ?string $modelLabel = 'Tema Bulanan';

    protected static ?int $navigationSort = 1;

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\Section::make('Periode')
                    ->schema([
                        Forms\Components\Select::make('bulan')
                            ->label('Bulan')
                            ->options([
                                1 => 'Januari', 2 => 'Februari', 3 => 'Maret', 4 => 'April',
                                5 => 'Mei', 6 => 'Juni', 7 => 'Juli', 8 => 'Agustus',
                                9 => 'September', 10 => 'Oktober', 11 => 'November', 12 => 'Desember',
                            ])
                            ->required(),
                        Forms\Components\TextInput::make('tahun')
                            ->label('Tahun')
                            ->numeric()
                            ->minValue(2020)
                            ->maxValue(2100)
                            ->default(now()->year)
                            ->required(),
                        Forms\Components\Select::make('status')
                            ->options([
                                'belum' => 'Belum Selesai',
                                'selesai' => 'Selesai',
                            ])
                            ->default('belum')
                            ->required(),
                    ])
                    ->columns(3),

                Forms\Components\Section::make('Tema')
                    ->schema([
                        Forms\Components\TextInput::make('tema_guru')
                            ->label('Tema untuk Guru')
                            ->required()
                            ->maxLength(255),
                        Forms\Components\TextInput::make('tema_siswa')
                            ->label('Tema untuk Siswa')
                            ->required()
                            ->maxLength(255),
                    ])
                    ->columns(2),

                Forms\Components\Section::make('Aturan Penulisan')
                    ->schema([
                        Forms\Components\RichEditor::make('aturan_penulisan')
                            ->label('Aturan Penulisan')
                            ->columnSpanFull(),
                    ]),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('nama_bulan')
                    ->label('Bulan')
                    ->sortable(query: fn ($query, $direction) => $query->orderBy('bulan', $direction)),
                Tables\Columns\TextColumn::make('tahun')
                    ->sortable(),
                Tables\Columns\TextColumn::make('tema_guru')
                    ->label('Tema Guru')
                    ->limit(30),
                Tables\Columns\TextColumn::make('tema_siswa')
                    ->label('Tema Siswa')
                    ->limit(30),
                Tables\Columns\TextColumn::make('literasis_count')
                    ->label('Jumlah Literasi')
                    ->counts('literasis'),
                Tables\Columns\BadgeColumn::make('status')
                    ->colors([
                        'warning' => 'belum',
                        'success' => 'selesai',
                    ])
                    ->formatStateUsing(fn (string $state) => $state === 'selesai' ? 'Selesai' : 'Belum Selesai'),
            ])
            ->filters([
                Tables\Filters\SelectFilter::make('status')
                    ->options([
                        'belum' => 'Belum Selesai',
                        'selesai' => 'Selesai',
                    ]),
                Tables\Filters\SelectFilter::make('tahun')
                    ->options(fn () => LiterasiTema::query()
                        ->distinct()
                        ->orderByDesc('tahun')
                        ->pluck('tahun', 'tahun')
                        ->toArray()),
            ])
            ->defaultSort('tahun', 'desc')
            ->actions([
                Tables\Actions\EditAction::make(),
                Tables\Actions\DeleteAction::make(),
            ])
            ->bulkActions([
                Tables\Actions\BulkActionGroup::make([
                    Tables\Actions\DeleteBulkAction::make(),
                ]),
            ]);
    }

    public static function getRelations(): array
    {
        return [];
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListLiterasiTemas::route('/'),
            'create' => Pages\CreateLiterasiTema::route('/create'),
            'edit' => Pages\EditLiterasiTema::route('/{record}/edit'),
        ];
    }
}