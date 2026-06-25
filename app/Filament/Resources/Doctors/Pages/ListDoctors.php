<?php

namespace App\Filament\Resources\Doctors\Pages;

use App\Filament\Resources\Doctors\DoctorResource;
use Filament\Actions\CreateAction;
use Filament\Resources\Pages\ListRecords;
use Filament\Schemas\Components\Tabs\Tab;
use Illuminate\Database\Eloquent\Builder;

class ListDoctors extends ListRecords
{
    protected static string $resource = DoctorResource::class;

    protected function getHeaderActions(): array
    {
        return [
            CreateAction::make(),
        ];
    }

        public function getTabs(): array
    {
        return [
            'all' => Tab::make('All Doctors'),
            'active' => Tab::make('Active')
                ->modifyQueryUsing(fn (Builder $query) => $query->where('status', 'active'))
                ->badge(fn () => $this->getModel()::where('status', 'active')->count()),
            'inactive' => Tab::make('Inactive')
                ->modifyQueryUsing(fn (Builder $query) => $query->where('status', '!=', 'active'))
                ->badge(fn () => $this->getModel()::where('status', '!=', 'active')->count())
                ->badgeColor('danger'),
        ];
    }
}
