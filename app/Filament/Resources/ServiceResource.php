<?php

namespace App\Filament\Resources;

use App\Filament\Resources\ServiceResource\Pages;
use App\Models\Service;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Support\Str;

class ServiceResource extends Resource
{
    protected static ?string $model = Service::class;

    protected static ?string $navigationIcon = 'heroicon-o-squares-2x2';

    protected static ?string $navigationGroup = 'İçerik';

    protected static ?string $navigationLabel = 'Hizmetler';

    protected static ?string $modelLabel = 'Hizmet';

    protected static ?string $pluralModelLabel = 'Hizmetler';

    protected static ?int $navigationSort = 1;

    public static function form(Form $form): Form
    {
        return $form->schema([
            Forms\Components\Section::make()
                ->columns(2)
                ->schema([
                    Forms\Components\TextInput::make('title')
                        ->label('Başlık')
                        ->required()
                        ->live(onBlur: true)
                        ->afterStateUpdated(fn (string $operation, $state, Forms\Set $set) => $operation === 'create' ? $set('slug', Str::slug($state)) : null),
                    Forms\Components\TextInput::make('slug')
                        ->label('Slug (URL)')
                        ->required()
                        ->unique(ignoreRecord: true),
                    Forms\Components\Select::make('icon')
                        ->label('İkon')
                        ->options([
                            'heroicon-o-bolt' => '⚡ Enerji / Gym',
                            'heroicon-o-fire' => '🔥 Yoğun Antrenman',
                            'heroicon-o-heart' => '❤️ Kardiyo',
                            'heroicon-o-user' => '👤 Kişisel Antrenör',
                            'heroicon-o-sparkles' => '✨ Wellness',
                            'heroicon-o-academic-cap' => '🎓 Beslenme',
                            'heroicon-o-users' => '👥 Grup Dersleri',
                            'heroicon-o-trophy' => '🏆 Performans',
                        ])
                        ->default('heroicon-o-bolt')
                        ->native(false),
                    Forms\Components\TextInput::make('short_description')
                        ->label('Kısa Açıklama')
                        ->maxLength(160),
                    Forms\Components\Textarea::make('description')
                        ->label('Açıklama')
                        ->rows(4)
                        ->columnSpanFull(),
                    Forms\Components\TagsInput::make('features')
                        ->label('Kapsam / Özellikler')
                        ->columnSpanFull(),
                    Forms\Components\FileUpload::make('image')
                        ->label('Görsel')
                        ->image()
                        ->disk('public')
                        ->directory('services')
                        ->columnSpanFull(),
                    Forms\Components\Toggle::make('is_active')->label('Aktif')->default(true),
                    Forms\Components\TextInput::make('sort_order')->label('Sıra')->numeric()->default(0),
                ]),
        ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->reorderable('sort_order')
            ->defaultSort('sort_order')
            ->columns([
                Tables\Columns\IconColumn::make('icon')
                    ->label('')
                    ->icon(fn ($state) => $state)
                    ->color('primary')
                    ->size('lg'),
                Tables\Columns\TextColumn::make('title')
                    ->label('Başlık')
                    ->weight('bold')
                    ->description(fn (Service $r) => $r->short_description)
                    ->searchable(),
                Tables\Columns\ToggleColumn::make('is_active')->label('Aktif'),
            ])
            ->actions([
                Tables\Actions\EditAction::make(),
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
            'index' => Pages\ListServices::route('/'),
            'create' => Pages\CreateService::route('/create'),
            'edit' => Pages\EditService::route('/{record}/edit'),
        ];
    }
}
