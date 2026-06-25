<?php

namespace App\Filament\Resources\Doctors\Schemas;

use App\Enums\GenderEnum;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Schemas\Components\Grid;
use Filament\Schemas\Components\Section;
use Filament\Schemas\Schema;

class DoctorForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema->schema([
            Section::class::make('Doctor Information')
                ->description('Basic information about the doctor')
                ->icon('heroicon-o-user-group')
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
                            TextInput::make('specialization')
                                ->required(),
                            TextInput::make('license_number')
                                ->required(),
                            TextInput::make('contact_number')
                                ->required(),
                            TextInput::make('address')
                                ->columnSpanFull()
                                ->required(),
                            Select::make('status')
                                ->options([
                                    'active' => 'Active',
                                    'inactive' => 'Inactive',
                                ])
                                ->default('active')
                                ->required(),

                        ]),
                ]),
            Section::make('Account Information (Optional)')
                ->description('Optional account information for the doctor')
                ->icon('heroicon-o-user-circle')
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
