<?php

namespace App\Filament\Resources\Patients\Schemas;

use App\Enums\GenderEnum;
use Filament\Forms\Components\DatePicker;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Schemas\Components\Grid;
use Filament\Schemas\Components\Section;
use Filament\Schemas\Schema;

class PatientForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema->schema([

            // ======================
            // 1. PATIENT INFORMATION SECTION
            // ======================
            Section::make('Patient Information')
                ->description('Basic information about the patient')
                ->icon('heroicon-o-user')
                ->schema([
                    Grid::make(2)
                        ->schema([
                            TextInput::make('first_name')
                                ->required(),

                            TextInput::make('last_name')
                                ->required(),

                            Select::make('gender')
                                ->options(GenderEnum::class)
                                ->default(GenderEnum::DEFAULT->value)
                                ->required(),

                            DatePicker::make('birthdate')
                                ->required(),

                            TextInput::make('contact_number')
                                ->required(),

                            TextInput::make('address')
                                ->columnSpanFull()
                                ->required(),

                            TextInput::make('emergency_contact_name')
                                ->required(),

                            TextInput::make('emergency_contact_number')
                                ->required(),
                        ]),
                ]),

            // ======================
            // 2. ACCOUNT INFORMATION SECTION (COLLAPSED)
            // ======================
            Section::make('Account Information (Optional)')
                ->description('Login credentials for patient portal')
                ->icon('heroicon-o-user-circle')
                ->collapsible()
                ->schema([
                    Grid::make(2)
                        ->schema([

                            TextInput::make('email')
                                ->email()
                                ->columnSpanFull()
                                ->afterStateHydrated(function ($component, $record) {
                                    $component->state($record?->user?->email);
                                }),

                            TextInput::make('password')
                                ->password()
                                ->revealable()
                                ->columnSpanFull()
                                ->dehydrated(fn ($state) => filled($state))
                                ->placeholder('••••••••')
                                ->helperText('Leave blank to keep the current password'),

                            TextInput::make('password_confirmation')
                                ->password()
                                ->revealable()
                                ->same('password')
                                ->columnSpanFull()
                                ->dehydrated(false)
                                ->helperText('Leave blank if you do not want to change the password'),

                        ]),
                ]),
        ]);
    }
}
