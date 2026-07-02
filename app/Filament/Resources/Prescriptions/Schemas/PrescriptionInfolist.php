<?php

namespace App\Filament\Resources\Prescriptions\Schemas;

use Filament\Infolists\Components\TextEntry;
use Filament\Schemas\Components\Grid;
use Filament\Schemas\Components\Section;
use Filament\Schemas\Schema;

class PrescriptionInfolist
{
    public static function configure(Schema $schema): Schema
    {
        return $schema->schema([
            Section::make('Prescription Details')
                ->icon('heroicon-o-beaker')
                ->columnSpanFull()
                ->schema([
                    Grid::make(3)
                        ->schema([
                            TextEntry::make('display_id')
                                ->label('Prescription ID')
                                ->badge()
                                ->color('gray'),

                            TextEntry::make('consultation.display_id')
                                ->label('Consultation ID')
                                ->badge()
                                ->color('gray'),

                            TextEntry::make('consultation.appointment.display_id')
                                ->label('Appointment ID')
                                ->badge()
                                ->color('gray'),
                        ]),
                ]),

            Grid::make(2)
                ->schema([
                    Section::make('Patient')
                        ->icon('heroicon-o-user')
                        ->schema([
                            TextEntry::make('consultation.appointment.patient.display_id')
                                ->label('Patient ID')
                                ->badge()
                                ->color('gray'),

                            TextEntry::make('consultation.appointment.patient.full_name')
                                ->label('Patient'),

                            TextEntry::make('consultation.appointment.patient.contact_number')
                                ->label('Contact'),
                        ]),

                    Section::make('Doctor')
                        ->icon('heroicon-o-user-circle')
                        ->schema([
                            TextEntry::make('consultation.appointment.doctor.display_id')
                                ->label('Doctor ID')
                                ->badge()
                                ->color('gray'),

                            TextEntry::make('consultation.appointment.doctor.full_name')
                                ->label('Doctor'),

                            TextEntry::make('consultation.appointment.doctor.specialization'),
                        ]),
                ]),

            Section::make('Medicine')
                ->icon('heroicon-o-document-text')
                ->columnSpanFull()
                ->schema([
                    Grid::make(2)
                        ->schema([
                            TextEntry::make('medicine'),
                            TextEntry::make('dosage'),
                            TextEntry::make('frequency'),
                            TextEntry::make('duration'),
                        ]),

                    TextEntry::make('instructions')
                        ->placeholder('No instructions provided.')
                        ->columnSpanFull(),
                ]),
        ]);
    }
}
