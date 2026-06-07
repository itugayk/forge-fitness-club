<?php

namespace App\Filament\Resources;

use App\Filament\Resources\MembershipPlanResource\Pages;
use App\Models\MembershipPlan;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Support\Str;

class MembershipPlanResource extends Resource
{
    protected static ?string $model = MembershipPlan::class;

    protected static ?string $navigationIcon = 'heroicon-o-credit-card';

    protected static ?string $navigationGroup = 'Üyelik & Başvurular';

    protected static ?string $navigationLabel = 'Üyelik Paketleri';

    protected static ?string $modelLabel = 'Üyelik Paketi';

    protected static ?string $pluralModelLabel = 'Üyelik Paketleri';

    protected static ?int $navigationSort = 1;

    public static function form(Form $form): Form
    {
        return $form->schema([
            Forms\Components\Section::make('Paket')
                ->columns(2)
                ->schema([
                    Forms\Components\TextInput::make('name')
                        ->label('Paket Adı')
                        ->required()
                        ->live(onBlur: true)
                        ->afterStateUpdated(fn (string $operation, $state, Forms\Set $set) => $operation === 'create' ? $set('slug', Str::slug($state)) : null),
                    Forms\Components\TextInput::make('slug')
                        ->label('Slug (URL)')
                        ->required()
                        ->unique(ignoreRecord: true),
                    Forms\Components\TextInput::make('tagline')
                        ->label('Slogan')
                        ->columnSpanFull()
                        ->placeholder('ör. Yeni başlayanlar için ideal'),
                ]),
            Forms\Components\Section::make('Fiyatlandırma (₺)')
                ->description('Aylık / 3 Aylık / Yıllık toplam ücretler.')
                ->columns(3)
                ->schema([
                    Forms\Components\TextInput::make('price_monthly')
                        ->label('Aylık')
                        ->numeric()->prefix('₺')->default(0),
                    Forms\Components\TextInput::make('price_quarterly')
                        ->label('3 Aylık (toplam)')
                        ->numeric()->prefix('₺')->default(0),
                    Forms\Components\TextInput::make('price_yearly')
                        ->label('Yıllık (toplam)')
                        ->numeric()->prefix('₺')->default(0),
                ]),
            Forms\Components\Section::make('Kapsam & Durum')
                ->columns(2)
                ->schema([
                    Forms\Components\TagsInput::make('features')
                        ->label('Paket İçeriği')
                        ->placeholder('Özellik ekle...')
                        ->columnSpanFull(),
                    Forms\Components\Toggle::make('is_featured')
                        ->label('Öne Çıkan Paket')
                        ->helperText('Fiyat tablosunda vurgulanır.'),
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
                Tables\Columns\TextColumn::make('name')
                    ->label('Paket')
                    ->weight('bold')
                    ->description(fn (MembershipPlan $r) => $r->tagline)
                    ->searchable(),
                Tables\Columns\TextColumn::make('price_monthly')->label('Aylık')->money('TRY'),
                Tables\Columns\TextColumn::make('price_quarterly')->label('3 Aylık')->money('TRY')->toggleable(),
                Tables\Columns\TextColumn::make('price_yearly')->label('Yıllık')->money('TRY'),
                Tables\Columns\IconColumn::make('is_featured')->label('Öne Çıkan')->boolean(),
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
            'index' => Pages\ListMembershipPlans::route('/'),
            'create' => Pages\CreateMembershipPlan::route('/create'),
            'edit' => Pages\EditMembershipPlan::route('/{record}/edit'),
        ];
    }
}
