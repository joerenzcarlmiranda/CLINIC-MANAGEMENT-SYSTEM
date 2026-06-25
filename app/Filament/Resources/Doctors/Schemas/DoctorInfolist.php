<?php

namespace App\Filament\Resources\Doctors\Schemas;

use Filament\Infolists\Components\TextEntry;
use Filament\Schemas\Components\Grid;
use Filament\Schemas\Components\Section;
use Filament\Schemas\Schema;

class DoctorInfolist
{
    public static function configure(Schema $schema): Schema
    {
        return $schema->schema([
            Section::make('Doctor Information')
                ->description('Basic information about the doctor')
                ->icon('heroicon-o-user-group')
                // ->columnSpanFull() // Forces the structural box container to occupy full-width
                ->schema([
                    Grid::make(2)
                        ->schema([
                            TextEntry::make('id')
                                ->label('Doctor ID')
                                ->columnSpanFull(),

                            TextEntry::make('first_name')
                                ->label('First Name'),

                            TextEntry::make('last_name')
                                ->label('Last Name'),

                            TextEntry::make('gender')
                                ->label('Gender')
                                ->badge(),

                            TextEntry::make('specialization')
                                ->label('Specialization')
                                ->badge('success'),

                            TextEntry::make('license_number')
                                ->label('License Number'),

                            TextEntry::make('contact_number')
                                ->label('Contact Number'),

                            TextEntry::make('address')
                                ->label('Address')
                                ->columnSpanFull(),
                            TextEntry::make('status')
                                ->label('Status')
                                ->badge(fn ($record) => $record->status === 'active' ? 'success' : 'danger'),
                        ]),
                ]),
            Section::make('Account Information')
                ->description('Information about the related user account')
                ->icon('heroicon-o-user-circle')
                ->collapsible()
                // ->columnSpanFull() // Forces the structural box container to occupy full-width
                ->schema([
                    Grid::make(1)
                        ->schema([
                            TextEntry::make('user.name')
                                ->label('Doctor Name')
                                ->hidden(fn ($record) => empty($record?->user?->name)),

                            TextEntry::make('user.email')
                                ->label('Doctor Email'),
                        ]),
                ]),
        ]);
    }
}
