<?php

namespace App\Filament\Resources\Patients\Pages;

use App\Enums\GenderEnum; // Swap this with your actual GenderEnum namespace
use App\Filament\Resources\Patients\PatientResource;
use Filament\Actions\CreateAction;
use Filament\Resources\Pages\ListRecords;
use Filament\Schemas\Components\Tabs\Tab; // FIXED: Correct Filament Tab namespace
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Support\Facades\DB;

class ListPatients extends ListRecords
{
    protected static string $resource = PatientResource::class;

    protected function getHeaderActions(): array
    {
        return [
            CreateAction::make(),
        ];
    }

    public function getTabs(): array
    {
        // 1. Run a single optimized query to fetch all counts at once
        $counts = $this->getModel()::query()
            ->select('gender', DB::raw('count(*) as total'))
            ->groupBy('gender')
            ->pluck('total', 'gender');

        $allCount = $counts->sum();

        // 2. Start with the default baseline "All" tab
        $tabs = [
            'all' => Tab::make('All Patients')
                ->badge($allCount),
        ];

        // 3. Dynamically loop through your GenderEnum cases to build the tabs
        foreach (GenderEnum::cases() as $gender) {
            $tabs[$gender->value] = Tab::make($gender->getLabel() ?? $gender->name)
                ->modifyQueryUsing(fn (Builder $query) => $query->where('gender', $gender->value))
                ->badge($counts->get($gender->value, 0))
                ->icon($gender->getIcon()); // Optional visual anchor if defined in your Enum
        }

        return $tabs;
    }
}
