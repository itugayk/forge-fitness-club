<?php

namespace App\Filament\Resources;

use App\Filament\Resources\TrainerResource\Pages;
use App\Models\Trainer;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Support\Str;

class TrainerResource extends Resource
{
    protected static ?string $model = Trainer::class;

    protected static ?string $navigationIcon = 'heroicon-o-user-group';

    protected static ?string $navigationGroup = 'Ders Yönetimi';

    protected static ?string $navigationLabel = 'Eğitmenler';

    protected static ?string $modelLabel = 'Eğitmen';

    protected static ?string $pluralModelLabel = 'Eğitmenler';

    protected static ?int $navigationSort = 3;

    public static function form(Form $form): Form
    {
        return $form->schema([
            Forms\Components\Section::make('Eğitmen Bilgileri')
                ->columns(2)
                ->schema([
                    Forms\Components\TextInput::make('name')
                        ->label('Ad Soyad')
                        ->required()
                        ->live(onBlur: true)
                        ->afterStateUpdated(fn (string $operation, $state, Forms\Set $set) => $operation === 'create' ? $set('slug', Str::slug($state)) : null),
                    Forms\Components\TextInput::make('slug')
                        ->label('Slug (URL)')
                        ->required()
                        ->unique(ignoreRecord: true),
                    Forms\Components\TextInput::make('title')
                        ->label('Ünvan')
                        ->placeholder('ör. Baş Antrenör'),
                    Forms\Components\TextInput::make('specialty')
                        ->label('Uzmanlık')
                        ->placeholder('ör. CrossFit & HIIT'),
                    Forms\Components\TextInput::make('years_experience')
                        ->label('Tecrübe (yıl)')
                        ->numeric()
                        ->default(0),
                    Forms\Components\TextInput::make('instagram')
                        ->label('Instagram')
                        ->url()
                        ->prefixIcon('heroicon-m-link'),
                    Forms\Components\TagsInput::make('certifications')
                        ->label('Sertifikalar')
                        ->placeholder('Ekle...')
                        ->columnSpanFull(),
                    Forms\Components\Textarea::make('bio')
                        ->label('Biyografi')
                        ->rows(4)
                        ->columnSpanFull(),
                ]),
            Forms\Components\Section::make('Görsel & Durum')
                ->columns(2)
                ->schema([
                    Forms\Components\FileUpload::make('photo')
                        ->label('Fotoğraf')
                        ->image()
                        ->disk('public')
                        ->directory('trainers')
                        ->imageEditor()
                        ->columnSpanFull(),
                    Forms\Components\Toggle::make('is_active')
                        ->label('Aktif')
                        ->default(true),
                    Forms\Components\TextInput::make('sort_order')
                        ->label('Sıra')
                        ->numeric()
                        ->default(0),
                ]),
        ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->reorderable('sort_order')
            ->defaultSort('sort_order')
            ->columns([
                Tables\Columns\ImageColumn::make('photo')
                    ->label('')
                    ->disk('public')
                    ->circular(),
                Tables\Columns\TextColumn::make('name')
                    ->label('Ad Soyad')
                    ->weight('bold')
                    ->description(fn (Trainer $r) => $r->title)
                    ->searchable(),
                Tables\Columns\TextColumn::make('specialty')
                    ->label('Uzmanlık')
                    ->badge()
                    ->color('primary'),
                Tables\Columns\TextColumn::make('years_experience')
                    ->label('Tecrübe')
                    ->suffix(' yıl')
                    ->alignCenter(),
                Tables\Columns\ToggleColumn::make('is_active')
                    ->label('Aktif'),
            ])
            ->filters([
                Tables\Filters\TernaryFilter::make('is_active')->label('Aktif'),
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
            'index' => Pages\ListTrainers::route('/'),
            'create' => Pages\CreateTrainer::route('/create'),
            'edit' => Pages\EditTrainer::route('/{record}/edit'),
        ];
    }
}
