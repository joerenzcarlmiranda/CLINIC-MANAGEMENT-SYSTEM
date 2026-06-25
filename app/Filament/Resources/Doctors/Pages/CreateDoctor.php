<?php

namespace App\Filament\Resources\Doctors\Pages;

use App\Actions\CreateorUpdateDoctorAction;
use App\Filament\Resources\Doctors\DoctorResource;
use Filament\Resources\Pages\CreateRecord;
use Illuminate\Database\Eloquent\Model;

class CreateDoctor extends CreateRecord
{
    protected static string $resource = DoctorResource::class;

    protected function handleRecordCreation(array $data): Model
    {
        return app(CreateorUpdateDoctorAction::class)->execute($data);
    }
}
