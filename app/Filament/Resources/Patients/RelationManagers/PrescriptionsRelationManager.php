<?php

namespace App\Filament\Resources\Patients\RelationManagers;

use Filament\Actions\ViewAction;
use Filament\Resources\RelationManagers\RelationManager;
use Filament\Schemas\Schema;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;

class PrescriptionsRelationManager extends RelationManager
{
    protected static string $relationship = 'prescriptions';

    public function form(Schema $schema): Schema
    {
        return $schema->schema([]);
    }

    public function table(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('display_id')
                    ->label('Prescription ID')
                    ->badge()
                    ->color('gray'),
                TextColumn::make('consultation.display_id')
                    ->label('Consultation ID')
                    ->badge()
                    ->color('gray'),
                TextColumn::make('medicine'),
                TextColumn::make('dosage'),
                TextColumn::make('frequency'),
                TextColumn::make('duration'),
            ])
            ->recordActions([
                ViewAction::make()
                    ->url(fn ($record) => route('filament.admin.resources.prescriptions.view', $record)),
            ]);
    }
}
