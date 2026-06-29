<?php

namespace App\Filament\Resources\Appointments\Pages;

use App\Enums\AppointmentStatusEnum;
use App\Filament\Resources\Appointments\AppointmentResource;
use Filament\Actions\CreateAction;
use Filament\Schemas\Components\Tabs\Tab;
use Filament\Resources\Pages\ListRecords;
use Illuminate\Database\Eloquent\Builder;

class ListAppointments extends ListRecords
{
    protected static string $resource = AppointmentResource::class;

    protected function getHeaderActions(): array
    {
        return [
            CreateAction::make(),
        ];
    }

    public function getTabs(): array
    {
        return [
            'all' => Tab::make('All Appointments'),

            'pending' => Tab::make(AppointmentStatusEnum::Pending->getLabel())
                ->modifyQueryUsing(fn (Builder $query) => $query->where('status', AppointmentStatusEnum::Pending->value))
                ->badge(fn () => $this->getModel()::where('status', AppointmentStatusEnum::Pending->value)->count())
                ->badgeColor(AppointmentStatusEnum::Pending->getColor()),

            'confirmed' => Tab::make(AppointmentStatusEnum::Confirmed->getLabel())
                ->modifyQueryUsing(fn (Builder $query) => $query->where('status', AppointmentStatusEnum::Confirmed->value))
                ->badge(fn () => $this->getModel()::where('status', AppointmentStatusEnum::Confirmed->value)->count())
                ->badgeColor(AppointmentStatusEnum::Confirmed->getColor()),

            'completed' => Tab::make(AppointmentStatusEnum::Completed->getLabel())
                ->modifyQueryUsing(fn (Builder $query) => $query->where('status', AppointmentStatusEnum::Completed->value))
                ->badge(fn () => $this->getModel()::where('status', AppointmentStatusEnum::Completed->value)->count())
                ->badgeColor(AppointmentStatusEnum::Completed->getColor()),

            'cancelled' => Tab::make(AppointmentStatusEnum::Cancelled->getLabel())
                ->modifyQueryUsing(fn (Builder $query) => $query->where('status', AppointmentStatusEnum::Cancelled->value))
                ->badge(fn () => $this->getModel()::where('status', AppointmentStatusEnum::Cancelled->value)->count())
                ->badgeColor(AppointmentStatusEnum::Cancelled->getColor()),

            'no_show' => Tab::make(AppointmentStatusEnum::NoShow->getLabel())
                ->modifyQueryUsing(fn (Builder $query) => $query->where('status', AppointmentStatusEnum::NoShow->value))
                ->badge(fn () => $this->getModel()::where('status', AppointmentStatusEnum::NoShow->value)->count())
                ->badgeColor(AppointmentStatusEnum::NoShow->getColor()),
        ];
    }
}