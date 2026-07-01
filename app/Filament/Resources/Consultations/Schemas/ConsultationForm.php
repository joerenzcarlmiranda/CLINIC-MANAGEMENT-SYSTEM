<?php

namespace App\Filament\Resources\Consultations\Schemas;

use App\Enums\AppointmentStatusEnum;
use App\Models\Appointment;
use Filament\Forms\Components\DatePicker;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\Textarea;
use Filament\Schemas\Components\Grid;
use Filament\Schemas\Components\Section;
use Filament\Schemas\Schema;

class ConsultationForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema->schema([
            Section::make('Consultation Information')
                ->icon('heroicon-o-clipboard-document-list')
                ->columnSpanFull()
                ->schema([
                    Grid::make(2)
                        ->schema([
                            Select::make('appointment_id')
                                ->label('Appointment')
                                ->options(
                                    Appointment::query()
                                        ->whereIn('status', [
                                            AppointmentStatusEnum::Confirmed->value,
                                            AppointmentStatusEnum::Completed->value,
                                        ])
                                        ->whereDoesntHave('consultation')
                                        ->with(['patient', 'doctor'])
                                        ->get()
                                        ->mapWithKeys(fn (Appointment $a) => [
                                            $a->id => "{$a->display_id} — {$a->patient?->first_name} {$a->patient?->last_name} ({$a->appointment_date->format('M j, Y')})",
                                        ])
                                )
                                ->searchable()
                                ->required()
                                ->disabledOn('edit'),

                            DatePicker::make('consultation_date')
                                ->required(),

                            Textarea::make('chief_complaint')
                                ->required()
                                ->columnSpanFull(),

                            Textarea::make('diagnosis')
                                ->columnSpanFull(),

                            Textarea::make('treatment_plan')
                                ->columnSpanFull(),

                            Textarea::make('doctors_notes')
                                ->label("Doctor's Notes")
                                ->columnSpanFull(),
                        ]),
                ]),
        ]);
    }
}
