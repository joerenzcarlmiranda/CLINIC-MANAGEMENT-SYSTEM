<?php

namespace App\Filament\Resources\Patients\RelationManagers;

use Filament\Actions\ViewAction;
use Filament\Resources\RelationManagers\RelationManager;
use Filament\Schemas\Schema;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;

class ConsultationsRelationManager extends RelationManager
{
    protected static string $relationship = 'consultations';

    public function form(Schema $schema): Schema
    {
        return $schema->schema([]);
    }

    public function table(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('display_id')
                    ->label('Consultation ID')
                    ->badge()
                    ->color('gray'),
                TextColumn::make('appointment.doctor.full_name')
                    ->label('Doctor'),
                TextColumn::make('consultation_date')
                    ->date('M j, Y'),
                TextColumn::make('chief_complaint')
                    ->limit(40),
                TextColumn::make('diagnosis')
                    ->limit(40)
                    ->placeholder('Pending'),
            ])
            ->recordActions([
                ViewAction::make()
                    ->url(fn ($record) => route('filament.admin.resources.consultations.view', $record)),
            ]);
    }
}
