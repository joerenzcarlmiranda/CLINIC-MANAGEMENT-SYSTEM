<?php

namespace App\Filament\Resources\Consultations\Schemas;

use Filament\Infolists\Components\TextEntry;
use Filament\Schemas\Components\Grid;
use Filament\Schemas\Components\Section;
use Filament\Schemas\Schema;

class ConsultationInfolist
{
    public static function configure(Schema $schema): Schema
    {
        return $schema->schema([
            Section::make('Consultation Details')
                ->icon('heroicon-o-clipboard-document-list')
                ->columnSpanFull()
                ->schema([
                    Grid::make(3)
                        ->schema([
                            TextEntry::make('display_id')
                                ->label('Consultation ID')
                                ->badge()
                                ->color('gray'),

                            TextEntry::make('consultation_date')
                                ->date(),

                            TextEntry::make('appointment.display_id')
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
                            TextEntry::make('appointment.patient.display_id')
                                ->label('Patient ID')
                                ->badge()
                                ->color('gray'),

                            TextEntry::make('appointment.patient.full_name')
                                ->label('Patient'),

                            TextEntry::make('appointment.patient.gender'),

                            TextEntry::make('appointment.patient.contact_number'),
                        ]),

                    Section::make('Doctor')
                        ->icon('heroicon-o-user-circle')
                        ->schema([
                            TextEntry::make('appointment.doctor.display_id')
                                ->label('Doctor ID')
                                ->badge()
                                ->color('gray'),

                            TextEntry::make('appointment.doctor.full_name')
                                ->label('Doctor'),

                            TextEntry::make('appointment.doctor.specialization'),

                            TextEntry::make('appointment.doctor.contact_number'),
                        ]),
                ]),

            Section::make('Medical Notes')
                ->icon('heroicon-o-document-text')
                ->columnSpanFull()
                ->schema([
                    TextEntry::make('chief_complaint'),

                    TextEntry::make('diagnosis')
                        ->placeholder('No diagnosis provided.'),

                    TextEntry::make('treatment_plan')
                        ->placeholder('No treatment plan provided.'),

                    TextEntry::make('doctors_notes')
                        ->label("Doctor's Notes")
                        ->placeholder('No notes provided.'),
                ]),
        ]);
    }
}
