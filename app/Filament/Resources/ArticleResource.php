<?php

namespace App\Filament\Resources;

use App\Filament\Resources\ArticleResource\Pages;
use App\Models\Article;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Forms\Set;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Support\Str;

class ArticleResource extends Resource
{
    protected static ?string $model = Article::class;
    protected static ?string $navigationIcon = 'heroicon-o-newspaper';
    protected static ?string $navigationLabel = 'Artikel & Berita';
    protected static ?string $pluralModelLabel = 'Artikel';
    protected static ?int $navigationSort = 1;

    public static function form(Form $form): Form
    {
        return $form->schema([
            Forms\Components\Section::make('Informasi Artikel')
                ->schema([
                    Forms\Components\TextInput::make('title')
                        ->label('Judul')
                        ->required()
                        ->maxLength(255)
                        ->live(onBlur: true)
                        ->afterStateUpdated(
                            fn(Set $set, ?string $state) =>
                            $set('slug', Str::slug($state))
                        ),

                    Forms\Components\TextInput::make('slug')
                        ->label('Slug')
                        ->required()
                        ->unique(Article::class, 'slug', ignoreRecord: true)
                        ->maxLength(255),

                    Forms\Components\Select::make('category')
                        ->label('Kategori')
                        ->options([
                            'berita'       => 'Berita',
                            'pengumuman'   => 'Pengumuman',
                        ])
                        ->required(),

                    Forms\Components\Select::make('status')
                        ->label('Status')
                        ->options([
                            'draft'     => 'Draft',
                            'published' => 'Published',
                        ])
                        ->default('draft')
                        ->required()
                        ->live(),

                    Forms\Components\DateTimePicker::make('published_at')
                        ->label('Tanggal Publish')
                        ->visible(fn(Forms\Get $get) => $get('status') === 'published')
                        ->default(now()),
                ])->columns(2),

            Forms\Components\Section::make('Konten')
                ->schema([
                    Forms\Components\FileUpload::make('thumbnail')
                        ->label('Thumbnail')
                        ->image()
                        ->directory('articles/thumbnails')
                        ->imageResizeMode('cover')
                        ->imageCropAspectRatio('16:9')
                        ->nullable(),

                    Forms\Components\RichEditor::make('body')
                        ->label('Isi Artikel')
                        ->required()
                        ->columnSpanFull()
                        ->fileAttachmentsDirectory('articles/attachments'),
                ]),
        ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\ImageColumn::make('thumbnail')
                    ->label('Thumbnail')
                    ->width(80)
                    ->height(50),

                Tables\Columns\TextColumn::make('title')
                    ->label('Judul')
                    ->searchable()
                    ->sortable()
                    ->limit(50),

                Tables\Columns\BadgeColumn::make('category')
                    ->label('Kategori')
                    ->colors([
                        'info'    => 'berita',
                        'warning' => 'pengumuman',
                    ]),

                Tables\Columns\BadgeColumn::make('status')
                    ->label('Status')
                    ->colors([
                        'danger'  => 'draft',
                        'success' => 'published',
                    ]),

                Tables\Columns\TextColumn::make('user.name')
                    ->label('Penulis')
                    ->sortable(),

                Tables\Columns\TextColumn::make('published_at')
                    ->label('Tanggal Publish')
                    ->dateTime('d M Y, H:i')
                    ->sortable(),
            ])
            ->filters([
                Tables\Filters\SelectFilter::make('category')
                    ->label('Kategori')
                    ->options([
                        'berita'     => 'Berita',
                        'pengumuman' => 'Pengumuman',
                    ]),

                Tables\Filters\SelectFilter::make('status')
                    ->label('Status')
                    ->options([
                        'draft'     => 'Draft',
                        'published' => 'Published',
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
            ->actions([
                Tables\Actions\Action::make('view')
                    ->label('Lihat')
                    ->icon('heroicon-o-eye')
                    ->modalHeading(fn(Article $record) => $record->title)
                    ->modalContent(fn(Article $record) => view('filament.modals.article-detail', ['article' => $record]))
                    ->modalSubmitAction(false)
                    ->modalCancelActionLabel('Tutup'),

                Tables\Actions\EditAction::make(),
                Tables\Actions\DeleteAction::make(),
            ])
            ->defaultSort('created_at', 'desc');
    }

    public static function getPages(): array
    {
        return [
            'index'  => Pages\ListArticles::route('/'),
            'create' => Pages\CreateArticle::route('/create'),
            'edit'   => Pages\EditArticle::route('/{record}/edit'),
        ];
    }
}
