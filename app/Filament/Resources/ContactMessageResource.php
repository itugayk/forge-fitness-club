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

    protected static ?string $navigationGroup = 'Site';

    protected static ?string $navigationLabel = 'İletişim Mesajları';

    protected static ?string $modelLabel = 'Mesaj';

    protected static ?string $pluralModelLabel = 'İletişim Mesajları';

    protected static ?int $navigationSort = 1;

    public static function getNavigationBadge(): ?string
    {
        return (string) (ContactMessage::where('is_read', false)->count() ?: '');
    }

    public static function getNavigationBadgeColor(): ?string
    {
        return 'danger';
    }

    public static function canCreate(): bool
    {
        return false;
    }

    public static function form(Form $form): Form
    {
        return $form->schema([
            Forms\Components\Section::make()
                ->columns(2)
                ->schema([
                    Forms\Components\TextInput::make('name')->label('Ad Soyad')->disabled(),
                    Forms\Components\TextInput::make('email')->label('E-posta')->disabled(),
                    Forms\Components\TextInput::make('phone')->label('Telefon')->disabled(),
                    Forms\Components\TextInput::make('subject')->label('Konu')->disabled(),
                    Forms\Components\Textarea::make('message')->label('Mesaj')->disabled()->rows(5)->columnSpanFull(),
                    Forms\Components\Toggle::make('is_read')->label('Okundu olarak işaretle'),
                ]),
        ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->defaultSort('created_at', 'desc')
            ->columns([
                Tables\Columns\IconColumn::make('is_read')
                    ->label('')
                    ->boolean()
                    ->trueIcon('heroicon-o-envelope-open')
                    ->falseIcon('heroicon-s-envelope')
                    ->trueColor('gray')
                    ->falseColor('danger'),
                Tables\Columns\TextColumn::make('name')
                    ->label('Gönderen')
                    ->weight(fn (ContactMessage $r) => $r->is_read ? null : 'bold')
                    ->description(fn (ContactMessage $r) => $r->email)
                    ->searchable(),
                Tables\Columns\TextColumn::make('subject')->label('Konu')->placeholder('—')->limit(40),
                Tables\Columns\TextColumn::make('message')->label('Mesaj')->limit(50)->color('gray'),
                Tables\Columns\TextColumn::make('created_at')->label('Tarih')->since()->sortable(),
            ])
            ->filters([
                Tables\Filters\TernaryFilter::make('is_read')->label('Okundu'),
            ])
            ->actions([
                Tables\Actions\Action::make('toggleRead')
                    ->label(fn (ContactMessage $r) => $r->is_read ? 'Okunmadı' : 'Okundu')
                    ->icon('heroicon-m-check')
                    ->action(fn (ContactMessage $r) => $r->update(['is_read' => ! $r->is_read])),
                Tables\Actions\EditAction::make()->label('Aç'),
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
            'index' => Pages\ListContactMessages::route('/'),
            'edit' => Pages\EditContactMessage::route('/{record}/edit'),
        ];
    }
}
