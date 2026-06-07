<?php

namespace App\Filament\Widgets;

use App\Models\ClassBooking;
use App\Models\ClassSchedule;
use App\Models\ContactMessage;
use App\Models\MembershipApplication;
use App\Models\Trainer;
use Filament\Widgets\StatsOverviewWidget as BaseWidget;
use Filament\Widgets\StatsOverviewWidget\Stat;

class StatsOverview extends BaseWidget
{
    protected static ?int $sort = 1;

    protected static bool $isLazy = false;

    protected function getStats(): array
    {
        $newApplications = MembershipApplication::where('status', 'new')->count();

        return [
            Stat::make('Üyelik Başvuruları', MembershipApplication::count())
                ->description($newApplications.' yeni başvuru')
                ->descriptionIcon('heroicon-m-user-plus')
                ->color($newApplications > 0 ? 'success' : 'gray')
                ->chart([3, 5, 4, 7, 6, 9, 8]),

            Stat::make('Haftalık Ders', ClassSchedule::where('is_active', true)->count())
                ->description('Aktif program')
                ->descriptionIcon('heroicon-m-calendar-days')
                ->color('primary'),

            Stat::make('Aktif Eğitmen', Trainer::where('is_active', true)->count())
                ->description('Kadro')
                ->descriptionIcon('heroicon-m-user-group'),

            Stat::make('Ders Rezervasyonu', ClassBooking::where('status', 'confirmed')->count())
                ->description('Onaylı katılım')
                ->descriptionIcon('heroicon-m-bolt')
                ->color('warning'),

            Stat::make('Okunmamış Mesaj', ContactMessage::where('is_read', false)->count())
                ->description('İletişim kutusu')
                ->descriptionIcon('heroicon-m-envelope')
                ->color('danger'),
        ];
    }
}
