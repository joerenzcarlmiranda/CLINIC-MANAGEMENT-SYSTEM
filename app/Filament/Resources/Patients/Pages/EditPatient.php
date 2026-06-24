<?php

namespace App\Filament\Resources\Patients\Pages;

use App\Actions\CreateorUpdatePatientAction;
use App\Filament\Resources\Patients\PatientResource;
use Filament\Actions\DeleteAction;
use Filament\Actions\ViewAction;
use Filament\Resources\Pages\EditRecord;
use Illuminate\Database\Eloquent\Model;

class EditPatient extends EditRecord
{
    protected static string $resource = PatientResource::class;

    protected function handleRecordUpdate(Model $record, array $data): Model
    {
        return app(CreateorUpdatePatientAction::class)->execute($data, $record);
    }

    protected function getHeaderActions(): array
    {
        return [
            ViewAction::make(),
            DeleteAction::make(),
        ];
    }
}
