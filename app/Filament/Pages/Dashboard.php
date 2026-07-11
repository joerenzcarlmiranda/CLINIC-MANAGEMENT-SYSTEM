<?php

namespace App\Filament\Pages;

use App\Filament\Widgets\AppointmentsByStatusWidget;
use App\Filament\Widgets\AppointmentsTrendWidget;
use App\Filament\Widgets\PatientGrowthWidget;
use App\Filament\Widgets\RecentAppointmentsWidget;
use App\Filament\Widgets\StatsOverviewWidget;
use BackedEnum;
use Filament\Pages\Dashboard as BaseDashboard;
use Filament\Pages\Dashboard\Concerns\HasFiltersForm;
use Filament\Support\Icons\Heroicon;

class Dashboard extends BaseDashboard
{
    use HasFiltersForm;

    protected static string|BackedEnum|null $navigationIcon = Heroicon::Home;

    protected static string $routePath = '/';

    protected static ?string $title = 'Dashboard';

    public function getColumns(): int|array
    {
        return [
            'default' => 1,
            'sm' => 2,
            'md' => 2,
            'lg' => 4,
            'xl' => 4,
            '2xl' => 4,
        ];
    }

    public function getWidgets(): array
    {
        return [
            StatsOverviewWidget::class,
            AppointmentsTrendWidget::class,
            AppointmentsByStatusWidget::class,
            PatientGrowthWidget::class,
            RecentAppointmentsWidget::class,
        ];
    }
}
