<?php

namespace App\Filament\Widgets;

use App\Models\Appointment;
use Filament\Widgets\LineChartWidget;
use Illuminate\Support\Carbon;

class AppointmentsTrendWidget extends LineChartWidget
{
    protected static ?int $sort = 2;

    protected ?string $maxHeight = '280px';

    protected int|string|array $columnSpan = [
        'default' => 1,
        'sm' => 2,
        'lg' => 3,
    ];

    public function getHeading(): string
    {
        return 'Appointments — Last 30 Days';
    }

    protected function getData(): array
    {
        $days = collect(range(29, 0))->map(fn ($i) => now()->subDays($i)->format('Y-m-d'));

        $counts = Appointment::selectRaw('DATE(appointment_date) as date, COUNT(*) as count')
            ->where('appointment_date', '>=', now()->subDays(29)->startOfDay())
            ->groupBy('date')
            ->pluck('count', 'date');

        $labels = $days->map(fn ($d) => Carbon::parse($d)->format('M j'))->toArray();
        $data = $days->map(fn ($d) => $counts->get($d, 0))->toArray();

        return [
            'datasets' => [
                [
                    'label' => 'Appointments',
                    'data' => $data,
                    'borderColor' => '#3b82f6',
                    'backgroundColor' => 'rgba(59, 130, 246, 0.08)',
                    'borderWidth' => 2,
                    'pointBackgroundColor' => '#3b82f6',
                    'pointRadius' => 3,
                    'tension' => 0.4,
                    'fill' => true,
                ],
            ],
            'labels' => $labels,
        ];
    }

    protected function getOptions(): array
    {
        return [
            'plugins' => [
                'legend' => ['display' => false],
                'tooltip' => ['mode' => 'index', 'intersect' => false],
            ],
            'scales' => [
                'y' => [
                    'beginAtZero' => true,
                    'ticks' => ['stepSize' => 1],
                    'grid' => ['color' => 'rgba(0,0,0,0.04)'],
                ],
                'x' => [
                    'grid' => ['display' => false],
                ],
            ],
        ];
    }
}
