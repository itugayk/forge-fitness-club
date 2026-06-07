<?php

namespace App\Filament\Resources;

use App\Filament\Resources\ClassBookingResource\Pages;
use App\Models\ClassBooking;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;

class ClassBookingResource extends Resource
{
    protected static ?string $model = ClassBooking::class;

    protected static ?string $navigationIcon = 'heroicon-o-ticket';

    protected static ?string $navigationGroup = 'Ders Yönetimi';

    protected static ?string $navigationLabel = 'Ders Rezervasyonları';

    protected static ?string $modelLabel = 'Rezervasyon';

    protected static ?string $pluralModelLabel = 'Ders Rezervasyonları';

    protected static ?int $navigationSort = 4;

    public static function getNavigationBadge(): ?string
    {
        return (string) (ClassBooking::where('status', 'confirmed')->count() ?: '');
    }

    public static function form(Form $form): Form
    {
        return $form->schema([
            Forms\Components\Section::make()
                ->columns(2)
                ->schema([
                    Forms\Components\Select::make('class_schedule_id')
                        ->label('Ders')
                        ->relationship('schedule', 'title')
                        ->getOptionLabelFromRecordUsing(fn ($record) => $record->day_name.' '.$record->start_label.' · '.$record->title)
                        ->searchable()
                        ->preload()
                        ->required(),
                    Forms\Components\Select::make('status')
                        ->label('Durum')
                        ->options(ClassBooking::statuses())
                        ->default('confirmed')
                        ->required()
                        ->native(false),
                    Forms\Components\TextInput::make('name')->label('Ad Soyad')->required(),
                    Forms\Components\TextInput::make('email')->label('E-posta')->email()->required(),
                    Forms\Components\TextInput::make('phone')->label('Telefon'),
                    Forms\Components\Textarea::make('notes')->label('Not')->columnSpanFull(),
                ]),
        ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->defaultSort('created_at', 'desc')
            ->columns([
                Tables\Columns\TextColumn::make('schedule.title')
                    ->label('Ders')
                    ->weight('bold')
                    ->description(fn (ClassBooking $r) => $r->schedule ? $r->schedule->day_name.' · '.$r->schedule->start_label : null)
                    ->searchable(),
                Tables\Columns\TextColumn::make('name')->label('Üye')->searchable(),
                Tables\Columns\TextColumn::make('email')->label('E-posta')->toggleable(),
                Tables\Columns\TextColumn::make('phone')->label('Telefon')->toggleable(),
                Tables\Columns\SelectColumn::make('status')
                    ->label('Durum')
                    ->options(ClassBooking::statuses()),
                Tables\Columns\TextColumn::make('created_at')->label('Tarih')->since()->sortable(),
            ])
            ->filters([
                Tables\Filters\SelectFilter::make('status')->label('Durum')->options(ClassBooking::statuses()),
            ])
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
            'index' => Pages\ListClassBookings::route('/'),
            'create' => Pages\CreateClassBooking::route('/create'),
            'edit' => Pages\EditClassBooking::route('/{record}/edit'),
        ];
    }
}
