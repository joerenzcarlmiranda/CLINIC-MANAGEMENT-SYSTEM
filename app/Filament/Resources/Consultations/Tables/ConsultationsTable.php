<?php

namespace App\Filament\Resources\Consultations\Tables;

use Filament\Actions\BulkActionGroup;
use Filament\Actions\DeleteBulkAction;
use Filament\Actions\EditAction;
use Filament\Actions\ViewAction;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;

class ConsultationsTable
{
    public static function configure(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('display_id')
                    ->label('Consultation ID')
                    ->searchable()
                    ->copyable()
                    ->badge()
                    ->color('gray'),

                TextColumn::make('appointment.display_id')
                    ->label('Appointment ID')
                    ->badge()
                    ->color('gray'),

                TextColumn::make('appointment.patient.full_name')
                    ->label('Patient')
                    ->searchable(query: fn ($query, string $search) => $query->orWhereHas(
                        'appointment.patient',
                        fn ($q) => $q->where('first_name', 'like', "%{$search}%")
                            ->orWhere('last_name', 'like', "%{$search}%")
                    )),

                TextColumn::make('appointment.doctor.full_name')
                    ->label('Doctor')
                    ->searchable(query: fn ($query, string $search) => $query->orWhereHas(
                        'appointment.doctor',
                        fn ($q) => $q->where('first_name', 'like', "%{$search}%")
                            ->orWhere('last_name', 'like', "%{$search}%")
                    )),

                TextColumn::make('consultation_date')
                    ->date('F j, Y'),

                TextColumn::make('chief_complaint')
                    ->limit(40),
            ])
            ->filters([])
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
