<?php

namespace App\Filament\Widgets;

use App\Models\ClassBooking;
use App\Models\ClassSchedule;
use Filament\Widgets\ChartWidget;

class BookingsChart extends ChartWidget
{
    protected static ?int $sort = 3;

    protected static bool $isLazy = false;

    protected static ?string $heading = 'Gün Bazlı Ders Rezervasyonları';

    protected static ?string $maxHeight = '260px';

    protected function getData(): array
    {
        $shorts = ClassSchedule::dayShorts();

        $counts = [];
        foreach (array_keys($shorts) as $day) {
            $counts[] = ClassBooking::where('status', 'confirmed')
                ->whereHas('schedule', fn ($q) => $q->where('day_of_week', $day))
                ->count();
        }

        return [
            'datasets' => [
                [
                    'label' => 'Onaylı rezervasyon',
                    'data' => $counts,
                    'backgroundColor' => '#c5ff3d',
                    'borderColor' => '#aef000',
                    'borderRadius' => 6,
                ],
            ],
            'labels' => array_values($shorts),
        ];
    }

    protected function getType(): string
    {
        return 'bar';
    }
}
