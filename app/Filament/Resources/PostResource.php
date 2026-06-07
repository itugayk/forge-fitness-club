<?php

namespace App\Filament\Resources;

use App\Filament\Resources\PostResource\Pages;
use App\Models\Post;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Support\Str;

class PostResource extends Resource
{
    protected static ?string $model = Post::class;

    protected static ?string $navigationIcon = 'heroicon-o-newspaper';

    protected static ?string $navigationGroup = 'İçerik';

    protected static ?string $navigationLabel = 'Blog Yazıları';

    protected static ?string $modelLabel = 'Yazı';

    protected static ?string $pluralModelLabel = 'Blog Yazıları';

    protected static ?int $navigationSort = 3;

    public static function form(Form $form): Form
    {
        return $form->schema([
            Forms\Components\Section::make()
                ->columns(2)
                ->schema([
                    Forms\Components\TextInput::make('title')
                        ->label('Başlık')
                        ->required()
                        ->columnSpanFull()
                        ->live(onBlur: true)
                        ->afterStateUpdated(fn (string $operation, $state, Forms\Set $set) => $operation === 'create' ? $set('slug', Str::slug($state)) : null),
                    Forms\Components\TextInput::make('slug')
                        ->label('Slug (URL)')
                        ->required()
                        ->unique(ignoreRecord: true),
                    Forms\Components\TextInput::make('category')
                        ->label('Kategori')
                        ->placeholder('ör. Antrenman, Beslenme'),
                    Forms\Components\Textarea::make('excerpt')
                        ->label('Özet')
                        ->rows(2)
                        ->columnSpanFull(),
                    Forms\Components\RichEditor::make('body')
                        ->label('İçerik')
                        ->columnSpanFull(),
                    Forms\Components\FileUpload::make('cover_image')
                        ->label('Kapak Görseli')
                        ->image()
                        ->disk('public')
                        ->directory('posts')
                        ->columnSpanFull(),
                ]),
            Forms\Components\Section::make('Yayın')
                ->columns(3)
                ->schema([
                    Forms\Components\TextInput::make('author')->label('Yazar')->default('Forge Ekibi'),
                    Forms\Components\TextInput::make('reading_minutes')->label('Okuma (dk)')->numeric()->default(4),
                    Forms\Components\DateTimePicker::make('published_at')->label('Yayın Tarihi')->default(now()),
                    Forms\Components\Toggle::make('is_published')->label('Yayında')->default(true),
                ]),
        ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->defaultSort('published_at', 'desc')
            ->columns([
                Tables\Columns\ImageColumn::make('cover_image')
                    ->label('')
                    ->disk('public'),
                Tables\Columns\TextColumn::make('title')
                    ->label('Başlık')
                    ->weight('bold')
                    ->searchable()
                    ->limit(48),
                Tables\Columns\TextColumn::make('category')->label('Kategori')->badge()->color('primary'),
                Tables\Columns\IconColumn::make('is_published')->label('Yayında')->boolean(),
                Tables\Columns\TextColumn::make('published_at')->label('Tarih')->date('d M Y')->sortable(),
            ])
            ->filters([
                Tables\Filters\TernaryFilter::make('is_published')->label('Yayında'),
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
            'index' => Pages\ListPosts::route('/'),
            'create' => Pages\CreatePost::route('/create'),
            'edit' => Pages\EditPost::route('/{record}/edit'),
        ];
    }
}
