<?php

namespace App\Filament\Resources;

use App\Filament\Resources\LiterasiResource\Pages;
use App\Models\Literasi;
use App\Models\LiterasiTema;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;

class LiterasiResource extends Resource
{
    protected static ?string $model = Literasi::class;

    protected static ?string $navigationIcon = 'heroicon-o-book-open';

    protected static ?string $navigationGroup = 'Literasi';

    protected static ?string $navigationLabel = 'Artikel Literasi';

    protected static ?string $modelLabel = 'Literasi';

    protected static ?int $navigationSort = 2;

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\Section::make('Informasi Literasi')
                    ->schema([
                        Forms\Components\Select::make('literasi_tema_id')
                            ->label('Tema Bulanan')
                            ->relationship('literasiTema', 'tema_guru')
                            ->getOptionLabelFromRecordUsing(
                                fn (LiterasiTema $record) => "{$record->nama_bulan} {$record->tahun}"
                            )
                            ->searchable()
                            ->preload()
                            ->required(),
                        Forms\Components\Select::make('tipe')
                            ->label('Tipe Penulis')
                            ->options([
                                'siswa' => 'Siswa',
                                'guru' => 'Guru',
                            ])
                            ->required()
                            ->live(),
                        Forms\Components\TextInput::make('nama_penulis')
                            ->label('Nama Penulis')
                            ->required()
                            ->maxLength(255),
                        Forms\Components\TextInput::make('judul')
                            ->label('Judul Literasi')
                            ->required()
                            ->maxLength(255)
                            ->live(onBlur: true)
                            ->afterStateUpdated(function (Forms\Set $set, ?string $state, string $operation) {
                                if ($operation === 'create') {
                                    $set('slug', $state ? \Illuminate\Support\Str::slug($state) : null);
                                }
                            })
                            ->columnSpanFull(),
                        Forms\Components\TextInput::make('slug')
                            ->label('Slug')
                            ->required()
                            ->maxLength(255)
                            ->unique(ignoreRecord: true)
                            ->helperText('Otomatis terisi dari judul, boleh diedit manual kalau perlu.')
                            ->columnSpanFull(),
                    ])
                    ->columns(3),

                Forms\Components\Section::make('Isi Literasi')
                    ->schema([
                        Forms\Components\FileUpload::make('thumbnail')
                            ->label('Thumbnail')
                            ->image()
                            ->disk('public')
                            ->directory('literasi-thumbnails')
                            ->nullable(),
                        Forms\Components\RichEditor::make('isi')
                            ->label('Isi Literasi')
                            ->required()
                            // Tanpa ini, gambar yang di-paste (mis. dari Word) akan
                            // di-embed sebagai base64 langsung di kolom "isi" —
                            // bikin ukuran konten meledak dan gampang 503 di server.
                            // Dengan disk/directory ini, gambar yang di-paste atau
                            // di-drop otomatis diupload ke storage dan hanya URL-nya
                            // yang disimpan di konten.
                            ->fileAttachmentsDisk('public')
                            ->fileAttachmentsDirectory('literasi-content')
                            ->fileAttachmentsVisibility('public')
                            ->columnSpanFull(),
                    ]),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\ImageColumn::make('thumbnail')
                    ->label('')
                    ->disk('public')
                    ->circular(),
                Tables\Columns\TextColumn::make('judul')
                    ->searchable()
                    ->limit(40),
                Tables\Columns\TextColumn::make('nama_penulis')
                    ->label('Penulis')
                    ->searchable(),
                Tables\Columns\BadgeColumn::make('tipe')
                    ->colors([
                        'info' => 'siswa',
                        'success' => 'guru',
                    ])
                    ->formatStateUsing(fn (string $state) => ucfirst($state)),
                Tables\Columns\TextColumn::make('literasiTema.nama_bulan')
                    ->label('Tema Bulan')
                    ->formatStateUsing(fn ($record) => "{$record->literasiTema->nama_bulan} {$record->literasiTema->tahun}"),
                Tables\Columns\TextColumn::make('created_at')
                    ->label('Tanggal Upload')
                    ->dateTime('d M Y')
                    ->sortable(),
            ])
            ->filters([
                Tables\Filters\SelectFilter::make('tipe')
                    ->options([
                        'siswa' => 'Siswa',
                        'guru' => 'Guru',
                    ]),
                Tables\Filters\SelectFilter::make('literasi_tema_id')
                    ->label('Tema Bulanan')
                    ->relationship('literasiTema', 'tema_guru')
                    ->getOptionLabelFromRecordUsing(
                        fn (LiterasiTema $record) => "{$record->nama_bulan} {$record->tahun}"
                    ),
            ])
            ->defaultSort('created_at', 'desc')
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

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListLiterasis::route('/'),
            'create' => Pages\CreateLiterasi::route('/create'),
            'edit' => Pages\EditLiterasi::route('/{record}/edit'),
        ];
    }
}