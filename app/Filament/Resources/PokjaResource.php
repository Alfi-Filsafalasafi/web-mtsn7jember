<?php

namespace App\Filament\Resources;

use App\Filament\Resources\PokjaResource\Pages;
use App\Models\Pokja;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;

class PokjaResource extends Resource
{
    protected static ?string $model = Pokja::class;
    protected static ?string $navigationIcon = 'heroicon-o-shield-check';
    protected static ?string $navigationLabel = 'Evidence ZI';
    protected static ?string $pluralModelLabel = 'Evidence ZI (Pokja)';
    protected static ?string $navigationGroup = 'Zona Integritas';
    protected static ?int $navigationSort = 1;

    public static function form(Form $form): Form
    {
        return $form->schema([
            Forms\Components\Section::make('Data Pokja')
                ->schema([
                    Forms\Components\TextInput::make('name')
                        ->label('Nama Pokja')
                        ->required()
                        ->maxLength(255)
                        ->placeholder('Pokja 1. Manajemen Perubahan'),

                    Forms\Components\TextInput::make('gdrive_url')
                        ->label('Link Google Drive')
                        ->required()
                        ->url()
                        ->maxLength(255)
                        ->placeholder('https://drive.google.com/drive/folders/...'),

                    Forms\Components\Textarea::make('description')
                        ->label('Deskripsi')
                        ->required()
                        ->rows(4)
                        ->columnSpanFull(),

                    Forms\Components\TextInput::make('sort_order')
                        ->label('Urutan Tampil')
                        ->numeric()
                        ->default(0)
                        ->helperText('Angka kecil tampil lebih dulu'),
                ])->columns(2),

            Forms\Components\Section::make('Logo')
                ->schema([
                    Forms\Components\FileUpload::make('logo')
                        ->label('Logo Pokja')
                        ->image()
                        ->directory('pokja/logos')
                        ->imageResizeMode('cover')
                        ->imageCropAspectRatio('1:1')
                        ->nullable(),
                ]),
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

                Tables\Columns\TextColumn::make('name')
                    ->label('Nama Pokja')
                    ->searchable()
                    ->sortable(),

                Tables\Columns\TextColumn::make('description')
                    ->label('Deskripsi')
                    ->limit(50)
                    ->tooltip(fn($record) => $record->description),

                Tables\Columns\TextColumn::make('gdrive_url')
                    ->label('Link Drive')
                    ->url(fn($record) => $record->gdrive_url)
                    ->openUrlInNewTab()
                    ->limit(30),

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
            'index'  => Pages\ListPokjas::route('/'),
            'create' => Pages\CreatePokja::route('/create'),
            'edit'   => Pages\EditPokja::route('/{record}/edit'),
        ];
    }
}
