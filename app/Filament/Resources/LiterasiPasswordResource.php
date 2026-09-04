<?php

namespace App\Filament\Resources;

use App\Filament\Resources\LiterasiPasswordResource\Pages;
use App\Models\LiterasiPassword;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;

class LiterasiPasswordResource extends Resource
{
    protected static ?string $model = LiterasiPassword::class;

    protected static ?string $navigationIcon = 'heroicon-o-lock-closed';

    protected static ?string $navigationGroup = 'Literasi';

    protected static ?string $navigationLabel = 'Password Konfirmasi';

    protected static ?string $modelLabel = 'Password Konfirmasi';

    protected static ?int $navigationSort = 3;

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\Section::make('Password Konfirmasi Upload Literasi')
                    ->description('Password ini akan diminta ke guru/siswa saat submit literasi lewat form publik.')
                    ->schema([
                        Forms\Components\TextInput::make('password')
                            ->label('Password Baru')
                            ->password()
                            ->revealable()
                            ->required()
                            ->dehydrateStateUsing(fn (string $state) => $state)
                            ->helperText('Isi dengan password baru. Password lama tidak ditampilkan di sini karena disimpan terenkripsi.'),
                    ]),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('id')
                    ->label('ID'),
                Tables\Columns\TextColumn::make('updated_at')
                    ->label('Terakhir Diubah')
                    ->dateTime('d M Y, H:i'),
            ])
            ->actions([
                Tables\Actions\EditAction::make()
                    ->label('Ganti Password'),
            ])
            ->bulkActions([]);
    }

    /**
     * Hanya boleh ada 1 record (singleton). Sembunyikan tombol "Create" kalau sudah ada record.
     */
    public static function canCreate(): bool
    {
        return ! LiterasiPassword::exists();
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListLiterasiPasswords::route('/'),
            'create' => Pages\CreateLiterasiPassword::route('/create'),
            'edit' => Pages\EditLiterasiPassword::route('/{record}/edit'),
        ];
    }
}