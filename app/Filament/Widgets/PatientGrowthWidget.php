<?php

namespace App\Filament\Widgets;

use App\Models\Patient;
use Filament\Widgets\BarChartWidget;

class PatientGrowthWidget extends BarChartWidget
{
    protected static ?int $sort = 4;

    protected ?string $maxHeight = '280px';

    protected int|string|array $columnSpan = [
        'default' => 1,
        'sm' => 2,
        'lg' => 2,
    ];

    public function getHeading(): string
    {
        return 'New Patients — Last 6 Months';
    }

    protected function getData(): array
    {
        $months = collect(range(5, 0))->map(fn ($i) => now()->subMonths($i));

        $counts = Patient::selectRaw('YEAR(created_at) as year, MONTH(created_at) as month, COUNT(*) as count')
            ->where('created_at', '>=', now()->subMonths(5)->startOfMonth())
            ->groupBy('year', 'month')
            ->get()
            ->keyBy(fn ($row) => "{$row->year}-{$row->month}");

        $labels = $months->map(fn ($m) => $m->format('M Y'))->toArray();
        $data = $months->map(fn ($m) => (int) ($counts->get("{$m->year}-{$m->month}")?->count ?? 0))->toArray();

        return [
            'datasets' => [
                [
                    'label' => 'New Patients',
                    'data' => $data,
                    'backgroundColor' => 'rgba(34, 197, 94, 0.85)',
                    'borderRadius' => 6,
                    'borderWidth' => 0,
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
