<?php

namespace App\Filament\Resources;

use App\Filament\Resources\ClassCategoryResource\Pages;
use App\Models\ClassCategory;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Support\Str;

class ClassCategoryResource extends Resource
{
    protected static ?string $model = ClassCategory::class;

    protected static ?string $navigationIcon = 'heroicon-o-tag';

    protected static ?string $navigationGroup = 'Ders Yönetimi';

    protected static ?string $navigationLabel = 'Ders Kategorileri';

    protected static ?string $modelLabel = 'Ders Kategorisi';

    protected static ?string $pluralModelLabel = 'Ders Kategorileri';

    protected static ?int $navigationSort = 2;

    public static function form(Form $form): Form
    {
        return $form->schema([
            Forms\Components\Section::make()
                ->columns(2)
                ->schema([
                    Forms\Components\TextInput::make('name')
                        ->label('Kategori Adı')
                        ->required()
                        ->live(onBlur: true)
                        ->afterStateUpdated(fn (string $operation, $state, Forms\Set $set) => $operation === 'create' ? $set('slug', Str::slug($state)) : null),
                    Forms\Components\TextInput::make('slug')
                        ->label('Slug (URL)')
                        ->required()
                        ->unique(ignoreRecord: true),
                    Forms\Components\ColorPicker::make('color')
                        ->label('Takvim Rengi')
                        ->default('#c5ff3d'),
                    Forms\Components\TextInput::make('sort_order')->label('Sıra')->numeric()->default(0),
                    Forms\Components\Textarea::make('description')
                        ->label('Açıklama')
                        ->rows(2)
                        ->columnSpanFull(),
                ]),
        ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->reorderable('sort_order')
            ->defaultSort('sort_order')
            ->columns([
                Tables\Columns\ColorColumn::make('color')->label('Renk'),
                Tables\Columns\TextColumn::make('name')->label('Kategori')->weight('bold')->searchable(),
                Tables\Columns\TextColumn::make('schedules_count')
                    ->label('Ders Sayısı')
                    ->counts('schedules')
                    ->badge()
                    ->color('primary'),
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
            'index' => Pages\ListClassCategories::route('/'),
            'create' => Pages\CreateClassCategory::route('/create'),
            'edit' => Pages\EditClassCategory::route('/{record}/edit'),
        ];
    }
}
