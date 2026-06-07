<?php

namespace App\Filament\Widgets;

use App\Models\MembershipApplication;
use Filament\Tables;
use Filament\Tables\Table;
use Filament\Widgets\TableWidget as BaseWidget;

class LatestApplications extends BaseWidget
{
    protected static ?int $sort = 2;

    protected static bool $isLazy = false;

    protected int|string|array $columnSpan = 'full';

    protected static ?string $heading = 'Son Üyelik Başvuruları';

    public function table(Table $table): Table
    {
        return $table
            ->query(
                MembershipApplication::query()->with('plan')->latest()->limit(8)
            )
            ->columns([
                Tables\Columns\TextColumn::make('name')
                    ->label('Ad Soyad')
                    ->weight('bold')
                    ->searchable(),
                Tables\Columns\TextColumn::make('plan.name')
                    ->label('Paket')
                    ->badge()
                    ->color('primary')
                    ->placeholder('—'),
                Tables\Columns\TextColumn::make('phone')
                    ->label('Telefon'),
                Tables\Columns\TextColumn::make('status')
                    ->label('Durum')
                    ->badge()
                    ->formatStateUsing(fn (string $state) => MembershipApplication::statuses()[$state] ?? $state)
                    ->color(fn (string $state) => match ($state) {
                        'new' => 'success',
                        'contacted' => 'warning',
                        'approved' => 'primary',
                        'rejected' => 'danger',
                        default => 'gray',
                    }),
                Tables\Columns\TextColumn::make('created_at')
                    ->label('Tarih')
                    ->since(),
            ])
            ->paginated(false);
    }
}
