<?php

namespace App\Filament\Resources\Appointments\Tables;

use App\Enums\AppointmentStatusEnum;
use App\Models\Appointment;
use Filament\Actions\Action;
use Filament\Actions\BulkActionGroup;
use Filament\Actions\DeleteBulkAction;
use Filament\Actions\EditAction;
use Filament\Actions\ViewAction;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;

class AppointmentsTable
{
    public static function configure(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('display_id')
                    ->label('Appointment ID')
                    ->searchable()
                    ->copyable()
                    ->badge()
                    ->color('gray'),
                TextColumn::make('patient.full_name')
                    ->label('Patient Name')
                    ->searchable(query: function ($query, string $search) {
                        $query->orWhereHas('patient', fn ($q) => $q
                            ->where('first_name', 'like', "%{$search}%")
                            ->orWhere('last_name', 'like', "%{$search}%")
                        );
                    }),
                TextColumn::make('doctor.full_name')
                    ->label('Doctor Name')
                    ->searchable(query: function ($query, string $search) {
                        $query->orWhereHas('doctor', fn ($q) => $q
                            ->where('first_name', 'like', "%{$search}%")
                            ->orWhere('last_name', 'like', "%{$search}%")
                        );
                    }),
                TextColumn::make('appointment_date')
                    ->date('F j, Y')
                    ->searchable(),
                TextColumn::make('appointment_time')
                    ->time('g:i A'),
                TextColumn::make('status')
                    ->badge()
                    ->searchable(),
            ])
            ->filters([
                //
            ])
            ->recordActions([

                // Confirm — visible when Pending
                Action::make('confirm')
                    ->label('Confirm')
                    ->icon(AppointmentStatusEnum::Confirmed->getIcon())
                    ->color(AppointmentStatusEnum::Confirmed->getColor())
                    ->visible(fn (Appointment $record): bool => $record->status === AppointmentStatusEnum::Pending)
                    ->requiresConfirmation()
                    ->modalHeading('Confirm Appointment')
                    ->modalDescription('Are you sure you want to confirm this appointment?')
                    ->action(fn (Appointment $record) => $record->update(['status' => AppointmentStatusEnum::Confirmed])),

                // Complete — visible when Confirmed
                Action::make('complete')
                    ->label('Complete')
                    ->icon(AppointmentStatusEnum::Completed->getIcon())
                    ->color(AppointmentStatusEnum::Completed->getColor())
                    ->visible(fn (Appointment $record): bool => $record->status === AppointmentStatusEnum::Confirmed)
                    ->requiresConfirmation()
                    ->modalHeading('Mark as Completed')
                    ->modalDescription('Are you sure you want to mark this appointment as completed?')
                    ->action(fn (Appointment $record) => $record->update(['status' => AppointmentStatusEnum::Completed])),

                // Cancel — visible when Pending or Confirmed
                Action::make('cancel')
                    ->label('Cancel')
                    ->icon(AppointmentStatusEnum::Cancelled->getIcon())
                    ->color(AppointmentStatusEnum::Cancelled->getColor())
                    ->visible(fn (Appointment $record): bool => in_array($record->status, [
                        AppointmentStatusEnum::Pending,
                        AppointmentStatusEnum::Confirmed,
                    ]))
                    ->requiresConfirmation()
                    ->modalHeading('Cancel Appointment')
                    ->modalDescription('Are you sure you want to cancel this appointment?')
                    ->action(fn (Appointment $record) => $record->update(['status' => AppointmentStatusEnum::Cancelled])),

                // No Show — visible when Pending or Confirmed
                Action::make('no_show')
                    ->label('No Show')
                    ->icon(AppointmentStatusEnum::NoShow->getIcon())
                    ->color(AppointmentStatusEnum::NoShow->getColor())
                    ->visible(fn (Appointment $record): bool => in_array($record->status, [
                        AppointmentStatusEnum::Pending,
                        AppointmentStatusEnum::Confirmed,
                    ]))
                    ->requiresConfirmation()
                    ->modalHeading('Mark as No Show')
                    ->modalDescription('Are you sure the patient did not show up for this appointment?')
                    ->action(fn (Appointment $record) => $record->update(['status' => AppointmentStatusEnum::NoShow])),

                ViewAction::make(),
                EditAction::make(),
            ])
            ->toolbarActions([
                BulkActionGroup::make([
                    DeleteBulkAction::make(),
                ]),
            ]);
    }
}
