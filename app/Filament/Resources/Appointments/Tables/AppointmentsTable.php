<?php

namespace App\Filament\Resources\Appointments\Tables;

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
                TextColumn::make('id')
                ->label('Appointment ID')
                ->searchable(),
                TextColumn::make('patient.full_name')
                ->label('Patient Name')
                ->searchable(),
                TextColumn::make('doctor.full_name')
                ->label('Doctor Name')
                ->searchable(),
                TextColumn::make('appointment_date')
                ->date('F j, Y')
                ->searchable(),
                TextColumn::make('appointment_time')
                ->time('g:i A'),
                TextColumn::make('status')
                ->searchable(),



                

            ])
            ->filters([
                //
            ])
            ->recordActions([
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
