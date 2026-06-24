<?php

namespace App\Filament\Resources\Patients\Schemas;

use Filament\Infolists\Components\TextEntry;
use Filament\Schemas\Schema;
use Filament\Schemas\Components\Section;
use Filament\Schemas\Components\Grid;

class PatientInfolist
{
    public static function configure(Schema $schema): Schema
    {
        return $schema->schema([
            Section::make('Patient Information')
                ->description('Basic information about the patient')
                ->icon('heroicon-o-user')
                // ->columnSpanFull() // Forces the structural box container to occupy full-width
                ->schema([
                    Grid::make(2)
                        ->schema([
                            TextEntry::make('id')
                                ->label('Patient ID')
                                ->columnSpanFull(),

                            TextEntry::make('first_name')
                                ->label('First Name'),

                            TextEntry::make('last_name')
                                ->label('Last Name'),

                            TextEntry::make('gender')
                                ->label('Gender')
                                ->badge(),       

                            TextEntry::make('birthdate')
                                ->label('Birthdate'),

                            TextEntry::make('contact_number')
                                ->label('Contact Number'),

                            TextEntry::make('address')
                                ->label('Address')
                                ->columnSpanFull(),
                        ]),
                ]),
            Section::make('Account Information')
                ->description('Information about the related user account')
                ->icon('heroicon-o-user-circle')
                // ->columnSpanFull() // Forces the structural box container to occupy full-width
                ->schema([
                    Grid::make(1)
                        ->schema([
                            TextEntry::make('user.name')
                                ->label('Patient Name'),

                            TextEntry::make('user.email')
                                ->label('Patient Email'),
                            
                            TextEntry::make('user.password')
                                ->label('Patient Password')
                                ->hidden()
                                ->dehydrateStateUsing(fn ($state) => $state ? '********' : null),
                        ]),
                ]),
        ]);
    }
}
