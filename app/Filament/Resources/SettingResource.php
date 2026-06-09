<?php

namespace App\Filament\Resources;

use App\Filament\Resources\SettingResource\Pages;
use App\Models\Setting;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;

class SettingResource extends Resource
{
    protected static ?string $model = Setting::class;
    protected static ?string $navigationIcon = 'heroicon-o-cog-6-tooth';
    protected static ?string $navigationLabel = 'Pengaturan';
    protected static ?string $pluralModelLabel = 'Pengaturan';
    protected static ?int $navigationSort = 4;

    public static function form(Form $form): Form
    {
        return $form->schema([
            Forms\Components\TextInput::make('key')
                ->label('Key')
                ->required()
                ->maxLength(255),

            Forms\Components\Textarea::make('value')
                ->label('Value')
                ->rows(3)
                ->nullable(),
        ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('key')
                    ->label('Key')
                    ->searchable()
                    ->sortable(),

                Tables\Columns\TextColumn::make('value')
                    ->label('Value')
                    ->limit(80)
                    ->placeholder('-'),

                Tables\Columns\TextColumn::make('updated_at')
                    ->label('Diperbarui')
                    ->dateTime('d M Y, H:i')
                    ->sortable(),
            ])
            ->actions([
                Tables\Actions\EditAction::make(),
            ])
            ->bulkActions([])
            ->paginated(false);
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListSettings::route('/'),
            'edit'  => Pages\EditSetting::route('/{record}/edit'),
        ];
    }
}
