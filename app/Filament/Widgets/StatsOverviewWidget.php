<?php

namespace App\Filament\Widgets;

use App\Enums\AppointmentStatusEnum;
use App\Models\Appointment;
use App\Models\Patient;
use Filament\Widgets\StatsOverviewWidget as BaseWidget;
use Filament\Widgets\StatsOverviewWidget\Stat;

class StatsOverviewWidget extends BaseWidget
{
    protected static ?int $sort = 1;

    protected function getStats(): array
    {
        $totalPatients     = Patient::count();
        $todayAppointments = Appointment::whereDate('appointment_date', today())->count();
        $pendingCount      = Appointment::where('status', AppointmentStatusEnum::Pending)->count();
        $completedMonth    = Appointment::where('status', AppointmentStatusEnum::Completed)
            ->whereMonth('appointment_date', now()->month)
            ->whereYear('appointment_date', now()->year)
            ->count();

        // Sparkline: patients registered per day last 7 days
        $patientTrend = Patient::selectRaw('DATE(created_at) as date, COUNT(*) as count')
            ->where('created_at', '>=', now()->subDays(6)->startOfDay())
            ->groupBy('date')
            ->orderBy('date')
            ->pluck('count')
            ->toArray();

        // Sparkline: appointments per day last 7 days
        $appointmentTrend = Appointment::selectRaw('DATE(appointment_date) as date, COUNT(*) as count')
            ->where('appointment_date', '>=', now()->subDays(6)->startOfDay())
            ->groupBy('date')
            ->orderBy('date')
            ->pluck('count')
            ->toArray();

        return [
            Stat::make('Total Patients', number_format($totalPatients))
                ->description('All registered patients')
                ->descriptionIcon('heroicon-m-users')
                ->chart($patientTrend ?: [0])
                ->color('primary'),

            Stat::make("Today's Appointments", $todayAppointments)
                ->description(today()->format('F j, Y'))
                ->descriptionIcon('heroicon-m-calendar-days')
                ->chart($appointmentTrend ?: [0])
                ->color('info'),

            Stat::make('Pending Approval', $pendingCount)
                ->description('Awaiting confirmation')
                ->descriptionIcon('heroicon-m-clock')
                ->color('warning'),

            Stat::make('Completed This Month', $completedMonth)
                ->description(now()->format('F Y'))
                ->descriptionIcon('heroicon-m-check-badge')
                ->color('success'),
        ];
    }
}
