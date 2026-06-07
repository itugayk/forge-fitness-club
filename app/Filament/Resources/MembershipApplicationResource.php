<?php

namespace App\Filament\Resources;

use App\Filament\Resources\MembershipApplicationResource\Pages;
use App\Models\MembershipApplication;
use App\Models\MembershipPlan;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;

class MembershipApplicationResource extends Resource
{
    protected static ?string $model = MembershipApplication::class;

    protected static ?string $navigationIcon = 'heroicon-o-clipboard-document-check';

    protected static ?string $navigationGroup = 'Üyelik & Başvurular';

    protected static ?string $navigationLabel = 'Üyelik Başvuruları';

    protected static ?string $modelLabel = 'Başvuru';

    protected static ?string $pluralModelLabel = 'Üyelik Başvuruları';

    protected static ?int $navigationSort = 2;

    public static function getNavigationBadge(): ?string
    {
        return (string) (MembershipApplication::where('status', 'new')->count() ?: '');
    }

    public static function getNavigationBadgeColor(): ?string
    {
        return 'success';
    }

    public static function form(Form $form): Form
    {
        return $form->schema([
            Forms\Components\Section::make('Başvuru Bilgileri')
                ->columns(2)
                ->schema([
                    Forms\Components\Select::make('membership_plan_id')
                        ->label('Paket')
                        ->relationship('plan', 'name')
                        ->preload(),
                    Forms\Components\Select::make('status')
                        ->label('Durum')
                        ->options(MembershipApplication::statuses())
                        ->default('new')
                        ->required()
                        ->native(false),
                    Forms\Components\TextInput::make('name')->label('Ad Soyad')->required(),
                    Forms\Components\TextInput::make('email')->label('E-posta')->email()->required(),
                    Forms\Components\TextInput::make('phone')->label('Telefon')->required(),
                    Forms\Components\DatePicker::make('birth_date')->label('Doğum Tarihi'),
                    Forms\Components\Select::make('goal')
                        ->label('Hedef')
                        ->options(MembershipApplication::goals()),
                    Forms\Components\Select::make('billing_period')
                        ->label('Ödeme Periyodu')
                        ->options(MembershipPlan::periods())
                        ->default('monthly'),
                    Forms\Components\Textarea::make('message')->label('Mesaj / Not')->columnSpanFull(),
                ]),
        ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->defaultSort('created_at', 'desc')
            ->columns([
                Tables\Columns\TextColumn::make('name')
                    ->label('Ad Soyad')
                    ->weight('bold')
                    ->description(fn (MembershipApplication $r) => $r->email)
                    ->searchable(),
                Tables\Columns\TextColumn::make('plan.name')
                    ->label('Paket')
                    ->badge()
                    ->color('primary')
                    ->placeholder('—'),
                Tables\Columns\TextColumn::make('billing_period')
                    ->label('Periyot')
                    ->formatStateUsing(fn ($state) => MembershipPlan::periods()[$state] ?? $state),
                Tables\Columns\TextColumn::make('phone')->label('Telefon'),
                Tables\Columns\TextColumn::make('goal')
                    ->label('Hedef')
                    ->formatStateUsing(fn ($state) => MembershipApplication::goals()[$state] ?? $state)
                    ->badge()
                    ->color('gray')
                    ->placeholder('—'),
                Tables\Columns\SelectColumn::make('status')
                    ->label('Durum')
                    ->options(MembershipApplication::statuses()),
                Tables\Columns\TextColumn::make('created_at')->label('Tarih')->since()->sortable(),
            ])
            ->filters([
                Tables\Filters\SelectFilter::make('status')->label('Durum')->options(MembershipApplication::statuses()),
                Tables\Filters\SelectFilter::make('membership_plan_id')->label('Paket')->relationship('plan', 'name'),
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
            'index' => Pages\ListMembershipApplications::route('/'),
            'create' => Pages\CreateMembershipApplication::route('/create'),
            'edit' => Pages\EditMembershipApplication::route('/{record}/edit'),
        ];
    }
}
