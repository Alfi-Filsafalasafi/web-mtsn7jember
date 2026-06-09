<?php

namespace App\Filament\Resources;

use App\Filament\Resources\TeacherResource\Pages;
use App\Models\Teacher;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;

class TeacherResource extends Resource
{
    protected static ?string $model = Teacher::class;
    protected static ?string $navigationIcon = 'heroicon-o-user-group';
    protected static ?string $navigationLabel = 'Guru & Staf';
    protected static ?string $pluralModelLabel = 'Guru & Staf';
    protected static ?int $navigationSort = 2;

    public static function form(Form $form): Form
    {
        return $form->schema([
            Forms\Components\Section::make('Informasi Personal')
                ->schema([
                    Forms\Components\TextInput::make('name')
                        ->label('Nama Lengkap')
                        ->required()
                        ->maxLength(255),

                    Forms\Components\TextInput::make('nip')
                        ->label('NIP')
                        ->nullable()
                        ->maxLength(30),

                    Forms\Components\TextInput::make('position')
                        ->label('Jabatan')
                        ->required()
                        ->maxLength(255)
                        ->placeholder('Kepala Sekolah / Guru Matematika / Staf TU'),

                    Forms\Components\TextInput::make('subject')
                        ->label('Mata Pelajaran')
                        ->nullable()
                        ->maxLength(255)
                        ->placeholder('Kosongkan jika bukan guru mapel'),

                    Forms\Components\Select::make('status')
                        ->label('Status')
                        ->options([
                            'aktif'       => 'Aktif',
                            'tidak aktif' => 'Tidak Aktif',
                        ])
                        ->default('aktif')
                        ->required(),

                    Forms\Components\TextInput::make('sort_order')
                        ->label('Urutan Tampil')
                        ->numeric()
                        ->default(0)
                        ->helperText('Angka kecil tampil lebih dulu'),
                ])->columns(2),

            Forms\Components\Section::make('Foto')
                ->schema([
                    Forms\Components\FileUpload::make('photo')
                        ->label('Foto')
                        ->image()
                        ->directory('teachers/photos')
                        ->imageResizeMode('cover')
                        ->imageCropAspectRatio('3:4')
                        ->nullable(),
                ]),
        ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\ImageColumn::make('photo')
                    ->label('Foto')
                    ->width(50)
                    ->height(65)
                    ->defaultImageUrl(asset('images/no-photo.png')),

                Tables\Columns\TextColumn::make('name')
                    ->label('Nama')
                    ->searchable()
                    ->sortable(),

                Tables\Columns\TextColumn::make('nip')
                    ->label('NIP')
                    ->searchable()
                    ->placeholder('-'),

                Tables\Columns\TextColumn::make('position')
                    ->label('Jabatan')
                    ->searchable(),

                Tables\Columns\TextColumn::make('subject')
                    ->label('Mata Pelajaran')
                    ->placeholder('-'),

                Tables\Columns\BadgeColumn::make('status')
                    ->label('Status')
                    ->colors([
                        'success' => 'aktif',
                        'danger'  => 'tidak aktif',
                    ]),

                Tables\Columns\TextColumn::make('sort_order')
                    ->label('Urutan')
                    ->sortable(),
            ])
            ->filters([
                Tables\Filters\SelectFilter::make('status')
                    ->label('Status')
                    ->options([
                        'aktif'       => 'Aktif',
                        'tidak aktif' => 'Tidak Aktif',
                    ]),
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
            'index'  => Pages\ListTeachers::route('/'),
            'create' => Pages\CreateTeacher::route('/create'),
            'edit'   => Pages\EditTeacher::route('/{record}/edit'),
        ];
    }
}
