<?php

namespace App\Filament\Resources\Patients\RelationManagers;

use Filament\Actions\ViewAction;
use Filament\Resources\RelationManagers\RelationManager;
use Filament\Schemas\Schema;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;

class AppointmentsRelationManager extends RelationManager
{
    protected static string $relationship = 'appointments';

    public function form(Schema $schema): Schema
    {
        return $schema->schema([]);
    }

    public function table(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('display_id')
                    ->label('Appointment ID')
                    ->badge()
                    ->color('gray'),
                TextColumn::make('doctor.full_name')
                    ->label('Doctor'),
                TextColumn::make('appointment_date')
                    ->date('M j, Y'),
                TextColumn::make('appointment_time')
                    ->time('g:i A'),
                TextColumn::make('status')
                    ->badge(),
                TextColumn::make('reason_for_visit'),
            ])
            ->recordActions([
                ViewAction::make()
                    ->url(fn ($record) => route('filament.admin.resources.appointments.view', $record)),
            ]);
    }
}
