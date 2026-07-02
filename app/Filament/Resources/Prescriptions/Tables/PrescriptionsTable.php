<?php

namespace App\Filament\Resources\Prescriptions\Tables;

use Filament\Actions\BulkActionGroup;
use Filament\Actions\DeleteBulkAction;
use Filament\Actions\EditAction;
use Filament\Actions\ViewAction;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;

class PrescriptionsTable
{
    public static function configure(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('display_id')
                    ->label('Prescription ID')
                    ->searchable()
                    ->copyable()
                    ->badge()
                    ->color('gray'),

                TextColumn::make('consultation.display_id')
                    ->label('Consultation ID')
                    ->badge()
                    ->color('gray'),

                TextColumn::make('consultation.appointment.patient.full_name')
                    ->label('Patient')
                    ->searchable(query: fn ($query, string $search) => $query->orWhereHas(
                        'consultation.appointment.patient',
                        fn ($q) => $q->where('first_name', 'like', "%{$search}%")
                            ->orWhere('last_name', 'like', "%{$search}%")
                    )),

                TextColumn::make('medicine')
                    ->searchable(),

                TextColumn::make('dosage'),

                TextColumn::make('frequency'),

                TextColumn::make('duration'),

                TextColumn::make('created_at')
                    ->dateTime()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
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
