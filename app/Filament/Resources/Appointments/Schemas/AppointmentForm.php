<?php

namespace App\Filament\Resources\Appointments\Schemas;

use Filament\Forms\Components\DatePicker;
use Filament\Forms\Components\DateTimePicker;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TimePicker;
use Filament\Schemas\Components\Grid;
use Filament\Schemas\Schema;
use Filament\Schemas\Components\Section;
use App\Enums\AppointmentStatusEnum;
use Filament\Forms\Components\TextInput;

use function Pest\Laravel\options;

class AppointmentForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema->schema([
            Section::make('Appointment Form Information')
            ->description('Appointment Basic Information')
            ->icon('heroicon-o-calendar')
            ->columnSpanFull()
            ->schema([
                Grid::make(2)
                ->schema([
                    Select::make('patient_id')
                    ->relationship('patient','first_name')
                    ->getOptionLabelFromRecordUsing(
                        fn ($record) => "{$record->first_name} {$record->last_name}"
                    )
                    ->searchable()
                    ->preload()
                    ->required(),
                    Select::make('doctor_id')
                    ->relationship('doctor','first_name')
                    ->getOptionLabelFromRecordUsing(
                        fn ($record) => "{$record->first_name} {$record->last_name}"
                    )
                    ->searchable()
                    ->preload()
                    ->required(),
                    DatePicker::make('appointment_date')
                    ->required(),
                    TimePicker::make('appointment_time')
                    ->required(),
                    Select::make('status')
                    ->required()
                    ->options(AppointmentStatusEnum::class)
                    ->default(AppointmentStatusEnum::Pending)
                    ->required(),

                    TextInput::make('reason_for_visit')
                    ->required(),
                    TextInput::make('notes'),

                    
                ]),
            ]),
        ]);
    }
}
