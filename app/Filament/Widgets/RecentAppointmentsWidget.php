<?php

namespace App\Filament\Widgets;

use App\Models\Appointment;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;
use Filament\Widgets\TableWidget as BaseWidget;

class RecentAppointmentsWidget extends BaseWidget
{
    protected static ?int $sort = 5;

    protected int|string|array $columnSpan = 'full';

    public function getHeading(): string
    {
        return 'Recent Appointments';
    }

    public function table(Table $table): Table
    {
        return $table
            ->query(
                Appointment::query()
                    ->with(['patient', 'doctor'])
                    ->latest('appointment_date')
                    ->limit(8)
            )
            ->columns([
                TextColumn::make('display_id')
                    ->label('ID')
                    ->badge()
                    ->color('gray'),

                TextColumn::make('patient.full_name')
                    ->label('Patient'),

                TextColumn::make('doctor.full_name')
                    ->label('Doctor'),

                TextColumn::make('appointment_date')
                    ->label('Date')
                    ->date('M j, Y'),

                TextColumn::make('appointment_time')
                    ->label('Time')
                    ->time('g:i A'),

                TextColumn::make('status')
                    ->badge(),

                TextColumn::make('reason_for_visit')
                    ->label('Reason')
                    ->limit(30),
            ])
            ->paginated(false);
    }
}
