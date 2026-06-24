<?php

namespace App\Filament\Resources\Patients\Pages;

use App\Actions\CreateorUpdatePatientAction;
use App\Filament\Resources\Patients\PatientResource;
use Filament\Resources\Pages\CreateRecord;
use Illuminate\Database\Eloquent\Model;

class CreatePatient extends CreateRecord
{
    protected static string $resource = PatientResource::class;

    protected function handleRecordCreation(array $data): Model
    {
        return app(CreateorUpdatePatientAction::class)->execute($data);
    }
}
