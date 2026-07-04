<?php

namespace App\Filament\Widgets;

use App\Enums\AppointmentStatusEnum;
use App\Models\Appointment;
use Filament\Widgets\DoughnutChartWidget;

class AppointmentsByStatusWidget extends DoughnutChartWidget
{
    protected static ?int $sort = 3;

    protected ?string $maxHeight = '280px';

    protected int|string|array $columnSpan = [
        'default' => 1,
        'sm'      => 1,
        'lg'      => 1,
    ];

    public function getHeading(): string
    {
        return 'Appointments by Status';
    }

    protected function getData(): array
    {
        $counts = Appointment::selectRaw('status, COUNT(*) as count')
            ->groupBy('status')
            ->pluck('count', 'status');

        $statuses = AppointmentStatusEnum::cases();

        return [
            'datasets' => [
                [
                    'data'            => collect($statuses)->map(fn ($s) => $counts->get($s->value, 0))->toArray(),
                    'backgroundColor' => [
                        '#f59e0b', // pending   — warning
                        '#3b82f6', // confirmed — info
                        '#22c55e', // completed — success
                        '#ef4444', // cancelled — danger
                        '#6b7280', // no_show   — gray
                    ],
                    'borderWidth'     => 0,
                    'hoverOffset'     => 6,
                ],
            ],
            'labels' => collect($statuses)->map(fn ($s) => $s->getLabel())->toArray(),
        ];
    }

    protected function getOptions(): array
    {
        return [
            'plugins' => [
                'legend' => [
                    'position' => 'bottom',
                    'labels'   => ['padding' => 16, 'usePointStyle' => true],
                ],
            ],
            'cutout' => '70%',
        ];
    }
}
