<?php

namespace App\Filament\Resources;

use App\Filament\Resources\TestimonialResource\Pages;
use App\Models\Testimonial;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;

class TestimonialResource extends Resource
{
    protected static ?string $model = Testimonial::class;

    protected static ?string $navigationIcon = 'heroicon-o-chat-bubble-left-right';

    protected static ?string $navigationGroup = 'İçerik';

    protected static ?string $navigationLabel = 'Üye Yorumları';

    protected static ?string $modelLabel = 'Yorum';

    protected static ?string $pluralModelLabel = 'Üye Yorumları';

    protected static ?int $navigationSort = 5;

    public static function form(Form $form): Form
    {
        return $form->schema([
            Forms\Components\Section::make()
                ->columns(2)
                ->schema([
                    Forms\Components\TextInput::make('name')->label('Ad Soyad')->required(),
                    Forms\Components\TextInput::make('role')->label('Rol / Etiket')->placeholder('ör. Üye · 2 yıl'),
                    Forms\Components\Textarea::make('content')->label('Yorum')->rows(4)->required()->columnSpanFull(),
                    Forms\Components\FileUpload::make('avatar')
                        ->label('Avatar')
                        ->image()
                        ->avatar()
                        ->disk('public')
                        ->directory('testimonials'),
                    Forms\Components\Select::make('rating')
                        ->label('Puan')
                        ->options([5 => '★★★★★', 4 => '★★★★', 3 => '★★★', 2 => '★★', 1 => '★'])
                        ->default(5),
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
                Tables\Columns\ImageColumn::make('avatar')->label('')->disk('public')->circular(),
                Tables\Columns\TextColumn::make('name')
                    ->label('Üye')
                    ->weight('bold')
                    ->description(fn (Testimonial $r) => $r->role)
                    ->searchable(),
                Tables\Columns\TextColumn::make('content')->label('Yorum')->limit(60),
                Tables\Columns\TextColumn::make('rating')
                    ->label('Puan')
                    ->formatStateUsing(fn ($state) => str_repeat('★', (int) $state))
                    ->color('warning'),
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
            'index' => Pages\ListTestimonials::route('/'),
            'create' => Pages\CreateTestimonial::route('/create'),
            'edit' => Pages\EditTestimonial::route('/{record}/edit'),
        ];
    }
}
