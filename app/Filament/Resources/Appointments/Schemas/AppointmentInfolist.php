<?php

namespace App\Filament\Resources\Appointments\Schemas;

use Faker\Provider\en_US\Text;
use Filament\Infolists\Components\TextEntry;
use Filament\Schemas\Components\Grid;
use Filament\Schemas\Components\Section;
use Filament\Schemas\Schema;

class AppointmentInfolist
{
    public static function configure(Schema $schema): Schema
    {
        return $schema->schema([
          Section::make('Appointment Details')
    ->icon('heroicon-o-calendar')
    ->description('Schedule information')
    ->columnSpanFull()
    ->schema([
        Grid::make(4)
            ->schema([
                TextEntry::make('appointment_date')
                    ->date(),

                TextEntry::make('appointment_time')
                    ->time(),

                TextEntry::make('status')
                    ->badge(),

                TextEntry::make('createdBy.name')
                    ->label('Created By'),
            ]),
    ]),

Grid::make(2)
    ->schema([

        Section::make('Patient')
            ->icon('heroicon-o-user')
            ->schema([
                TextEntry::make('patient.full_name')
                    ->label('Patient'),

                TextEntry::make('patient.gender'),

                TextEntry::make('patient.birthdate')
                    ->date(),

                TextEntry::make('patient.contact_number'),

                TextEntry::make('patient.email'),

                TextEntry::make('patient.address')
                    ->columnSpanFull(),
            ]),

        Section::make('Doctor')
            ->icon('heroicon-o-user-circle')
            ->schema([
                TextEntry::make('doctor.full_name'),

                TextEntry::make('doctor.specialization'),

                TextEntry::make('user.email'),

                TextEntry::make('doctor.contact_number'),
            ]),
    ]),

Section::make('Medical Information')
    ->icon('heroicon-o-document-text')
    ->columnSpanFull()
    ->schema([
        TextEntry::make('reason_for_visit'),

        TextEntry::make('notes')
            ->placeholder('No notes provided.'),
    ]),
        ]);
    }
}
