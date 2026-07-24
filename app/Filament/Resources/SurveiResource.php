<?php

namespace App\Filament\Resources;

use App\Filament\Resources\SurveiResource\Pages;
use App\Models\Survei;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;

class SurveiResource extends Resource
{
    protected static ?string $model = Survei::class;
    protected static ?string $navigationIcon = 'heroicon-o-clipboard-document-list';
    protected static ?string $navigationLabel = 'Survei';
    protected static ?string $pluralModelLabel = 'Survei';
    protected static ?string $navigationGroup = 'Zona Integritas';
    protected static ?int $navigationSort = 3;

    public static function form(Form $form): Form
    {
        return $form->schema([
            Forms\Components\Section::make('Data Survei')
                ->schema([
                    Forms\Components\TextInput::make('name')
                        ->label('Nama Survei')
                        ->required()
                        ->maxLength(255)
                        ->placeholder('Survei Kepuasan Masyarakat 2024'),

                    Forms\Components\TextInput::make('link')
                        ->label('Link Survei')
                        ->required()
                        ->url()
                        ->maxLength(255)
                        ->placeholder('https://forms.gle/...'),

                    Forms\Components\Textarea::make('description')
                        ->label('Keterangan')
                        ->required()
                        ->rows(4)
                        ->columnSpanFull(),

                    Forms\Components\TextInput::make('sort_order')
                        ->label('Urutan Tampil')
                        ->numeric()
                        ->default(0)
                        ->helperText('Angka kecil tampil lebih dulu'),
                ])->columns(2),
        ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('name')
                    ->label('Nama Survei')
                    ->searchable()
                    ->sortable(),

                Tables\Columns\TextColumn::make('description')
                    ->label('Keterangan')
                    ->limit(50)
                    ->tooltip(fn($record) => $record->description),

                Tables\Columns\TextColumn::make('link')
                    ->label('Link Survei')
                    ->url(fn($record) => $record->link)
                    ->openUrlInNewTab()
                    ->limit(35),

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
            'index'  => Pages\ListSurveis::route('/'),
            'create' => Pages\CreateSurvei::route('/create'),
            'edit'   => Pages\EditSurvei::route('/{record}/edit'),
        ];
    }
}
