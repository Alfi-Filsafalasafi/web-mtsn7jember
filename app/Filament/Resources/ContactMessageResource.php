<?php

namespace App\Filament\Resources;

use App\Filament\Resources\ContactMessageResource\Pages;
use App\Models\ContactMessage;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;

class ContactMessageResource extends Resource
{
    protected static ?string $model = ContactMessage::class;
    protected static ?string $navigationIcon = 'heroicon-o-envelope';
    protected static ?string $navigationLabel = 'Pesan Kontak';
    protected static ?string $pluralModelLabel = 'Pesan Kontak';
    protected static ?int $navigationSort = 3;

    // Tampilkan badge jumlah pesan belum dibaca di sidebar
    public static function getNavigationBadge(): ?string
    {
        $count = ContactMessage::unread()->count();
        return $count > 0 ? (string) $count : null;
    }

    public static function getNavigationBadgeColor(): ?string
    {
        return 'danger';
    }

    public static function form(Form $form): Form
    {
        return $form->schema([
            Forms\Components\Section::make('Informasi Pengirim')
                ->schema([
                    Forms\Components\TextInput::make('name')
                        ->label('Nama')
                        ->required()
                        ->maxLength(255),

                    Forms\Components\TextInput::make('email')
                        ->label('Email')
                        ->email()
                        ->required()
                        ->maxLength(255),

                    Forms\Components\TextInput::make('phone')
                        ->label('No. Telepon')
                        ->nullable()
                        ->maxLength(20),

                    Forms\Components\Toggle::make('is_read')
                        ->label('Sudah Dibaca')
                        ->default(false),
                ])->columns(2),

            Forms\Components\Section::make('Pesan')
                ->schema([
                    Forms\Components\Textarea::make('message')
                        ->label('Isi Pesan')
                        ->required()
                        ->rows(5)
                        ->columnSpanFull(),
                ]),
        ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('name')
                    ->label('Nama')
                    ->searchable()
                    ->sortable(),

                Tables\Columns\TextColumn::make('email')
                    ->label('Email')
                    ->searchable(),

                Tables\Columns\TextColumn::make('phone')
                    ->label('No. Telepon')
                    ->placeholder('-'),

                Tables\Columns\TextColumn::make('message')
                    ->label('Pesan')
                    ->limit(60)
                    ->tooltip(fn(ContactMessage $record) => $record->message),

                Tables\Columns\IconColumn::make('is_read')
                    ->label('Dibaca')
                    ->boolean()
                    ->trueIcon('heroicon-o-check-circle')
                    ->falseIcon('heroicon-o-x-circle')
                    ->trueColor('success')
                    ->falseColor('danger'),

                Tables\Columns\TextColumn::make('created_at')
                    ->label('Dikirim')
                    ->dateTime('d M Y, H:i')
                    ->sortable(),
            ])
            ->filters([
                Tables\Filters\SelectFilter::make('is_read')
                    ->label('Status Baca')
                    ->options([
                        '0' => 'Belum Dibaca',
                        '1' => 'Sudah Dibaca',
                    ]),
            ])
            ->actions([
                Tables\Actions\Action::make('view')
                    ->label('Lihat')
                    ->icon('heroicon-o-eye')
                    ->modalHeading(fn(ContactMessage $record) => 'Pesan dari ' . $record->name)
                    ->modalContent(fn(ContactMessage $record) => view('filament.modals.contact-detail', ['message' => $record]))
                    ->modalSubmitAction(false)
                    ->modalCancelActionLabel('Tutup')
                    ->after(fn(ContactMessage $record) => $record->update(['is_read' => true])),

                Tables\Actions\DeleteAction::make(),
            ])
            ->bulkActions([
                Tables\Actions\BulkActionGroup::make([
                    Tables\Actions\DeleteBulkAction::make(),
                ]),
            ])
            ->defaultSort('created_at', 'desc');
    }

    public static function getPages(): array
    {
        return [
            'index'  => Pages\ListContactMessages::route('/'),
            'create' => Pages\CreateContactMessage::route('/create'),
            'edit'   => Pages\EditContactMessage::route('/{record}/edit'),
        ];
    }
}
