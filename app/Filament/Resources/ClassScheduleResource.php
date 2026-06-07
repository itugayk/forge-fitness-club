<?php

namespace App\Filament\Resources;

use App\Filament\Resources\ClassScheduleResource\Pages;
use App\Models\ClassSchedule;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;

class ClassScheduleResource extends Resource
{
    protected static ?string $model = ClassSchedule::class;

    protected static ?string $navigationIcon = 'heroicon-o-calendar-days';

    protected static ?string $navigationGroup = 'Ders Yönetimi';

    protected static ?string $navigationLabel = 'Ders Programı';

    protected static ?string $modelLabel = 'Ders';

    protected static ?string $pluralModelLabel = 'Ders Programı';

    protected static ?int $navigationSort = 1;

    /** 06:00 – 23:00 arası 30 dk'lık zaman dilimleri. */
    protected static function timeOptions(): array
    {
        $options = [];
        for ($m = 6 * 60; $m <= 23 * 60; $m += 30) {
            $label = sprintf('%02d:%02d', intdiv($m, 60), $m % 60);
            $options[$label] = $label;
        }

        return $options;
    }

    public static function form(Form $form): Form
    {
        return $form->schema([
            Forms\Components\Section::make('Ders')
                ->columns(2)
                ->schema([
                    Forms\Components\TextInput::make('title')
                        ->label('Ders Adı')
                        ->required()
                        ->placeholder('ör. Vinyasa Yoga'),
                    Forms\Components\Select::make('class_category_id')
                        ->label('Kategori')
                        ->relationship('category', 'name')
                        ->searchable()
                        ->preload()
                        ->required(),
                    Forms\Components\Select::make('trainer_id')
                        ->label('Eğitmen')
                        ->relationship('trainer', 'name')
                        ->searchable()
                        ->preload(),
                    Forms\Components\Select::make('level')
                        ->label('Seviye')
                        ->options(ClassSchedule::levels())
                        ->default('orta')
                        ->required()
                        ->native(false),
                ]),
            Forms\Components\Section::make('Zaman & Kontenjan')
                ->columns(3)
                ->schema([
                    Forms\Components\Select::make('day_of_week')
                        ->label('Gün')
                        ->options(ClassSchedule::days())
                        ->required()
                        ->native(false),
                    Forms\Components\Select::make('start_time')
                        ->label('Başlangıç')
                        ->options(static::timeOptions())
                        ->formatStateUsing(fn ($state) => substr((string) $state, 0, 5))
                        ->required()
                        ->native(false),
                    Forms\Components\Select::make('end_time')
                        ->label('Bitiş')
                        ->options(static::timeOptions())
                        ->formatStateUsing(fn ($state) => substr((string) $state, 0, 5))
                        ->required()
                        ->native(false),
                    Forms\Components\TextInput::make('capacity')
                        ->label('Kontenjan')
                        ->numeric()
                        ->default(20)
                        ->required(),
                    Forms\Components\TextInput::make('room')
                        ->label('Salon / Alan')
                        ->placeholder('ör. Stüdyo A'),
                    Forms\Components\TextInput::make('sort_order')->label('Sıra')->numeric()->default(0),
                    Forms\Components\Textarea::make('description')
                        ->label('Açıklama')
                        ->rows(2)
                        ->columnSpanFull(),
                    Forms\Components\Toggle::make('is_active')->label('Aktif')->default(true),
                ]),
        ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->defaultSort('day_of_week')
            ->modifyQueryUsing(fn ($query) => $query->orderBy('day_of_week')->orderBy('start_time'))
            ->columns([
                Tables\Columns\TextColumn::make('day_of_week')
                    ->label('Gün')
                    ->formatStateUsing(fn ($state) => ClassSchedule::days()[$state] ?? $state)
                    ->badge()
                    ->color('gray'),
                Tables\Columns\TextColumn::make('start_time')
                    ->label('Saat')
                    ->formatStateUsing(fn ($state, ClassSchedule $r) => $r->start_label.' – '.$r->end_label)
                    ->icon('heroicon-m-clock'),
                Tables\Columns\TextColumn::make('title')
                    ->label('Ders')
                    ->weight('bold')
                    ->searchable(),
                Tables\Columns\TextColumn::make('category.name')
                    ->label('Kategori')
                    ->badge()
                    ->color(fn (ClassSchedule $r) => 'gray')
                    ->formatStateUsing(fn ($state) => $state),
                Tables\Columns\TextColumn::make('trainer.name')
                    ->label('Eğitmen')
                    ->placeholder('—'),
                Tables\Columns\TextColumn::make('level')
                    ->label('Seviye')
                    ->formatStateUsing(fn ($state) => ClassSchedule::levels()[$state] ?? $state)
                    ->badge()
                    ->color('warning'),
                Tables\Columns\TextColumn::make('capacity')
                    ->label('Doluluk')
                    ->badge()
                    ->color(fn (ClassSchedule $r) => $r->is_full ? 'danger' : 'primary')
                    ->formatStateUsing(fn (ClassSchedule $r) => $r->booked_count.' / '.$r->capacity),
                Tables\Columns\ToggleColumn::make('is_active')->label('Aktif'),
            ])
            ->filters([
                Tables\Filters\SelectFilter::make('day_of_week')
                    ->label('Gün')
                    ->options(ClassSchedule::days()),
                Tables\Filters\SelectFilter::make('class_category_id')
                    ->label('Kategori')
                    ->relationship('category', 'name'),
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
            'index' => Pages\ListClassSchedules::route('/'),
            'create' => Pages\CreateClassSchedule::route('/create'),
            'edit' => Pages\EditClassSchedule::route('/{record}/edit'),
        ];
    }
}
