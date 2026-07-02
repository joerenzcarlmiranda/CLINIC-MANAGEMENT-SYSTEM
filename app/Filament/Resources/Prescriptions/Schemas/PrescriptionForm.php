<?php

namespace App\Filament\Resources\Prescriptions\Schemas;

use App\Models\Consultation;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\TextInput;
use Filament\Schemas\Components\Grid;
use Filament\Schemas\Components\Section;
use Filament\Schemas\Schema;

class PrescriptionForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema->schema([
            Section::make('Prescription Details')
                ->icon('heroicon-o-beaker')
                ->columnSpanFull()
                ->schema([
                    Grid::make(2)
                        ->schema([
                            Select::make('consultation_id')
                                ->label('Consultation')
                                ->options(
                                    Consultation::query()
                                        ->with('appointment.patient')
                                        ->get()
                                        ->mapWithKeys(fn (Consultation $c) => [
                                            $c->id => "{$c->display_id} — {$c->appointment?->patient?->first_name} {$c->appointment?->patient?->last_name} ({$c->consultation_date?->format('M j, Y')})",
                                        ])
                                )
                                ->searchable()
                                ->required()
                                ->disabledOn('edit'),

                            TextInput::make('medicine')
                                ->required(),

                            TextInput::make('dosage')
                                ->required()
                                ->placeholder('e.g. 500mg'),

                            TextInput::make('frequency')
                                ->required()
                                ->placeholder('e.g. Twice daily'),

                            TextInput::make('duration')
                                ->required()
                                ->placeholder('e.g. 7 days'),

                            Textarea::make('instructions')
                                ->placeholder('e.g. Take after meals')
                                ->columnSpanFull(),
                        ]),
                ]),
        ]);
    }
}
