<?php

namespace App\Filament\Resources\Doctors\Pages;

use App\Actions\CreateorUpdateDoctorAction;
use App\Filament\Resources\Doctors\DoctorResource;
use Filament\Actions\DeleteAction;
use Filament\Actions\ViewAction;
use Filament\Resources\Pages\EditRecord;
use Illuminate\Database\Eloquent\Model;

class EditDoctor extends EditRecord
{
    protected static string $resource = DoctorResource::class;

    protected function handleRecordUpdate(Model $record, array $data): Model
    {
        return app(CreateorUpdateDoctorAction::class)->execute($data, $record);
    }

    protected function getHeaderActions(): array
    {
        return [
            ViewAction::make(),
            DeleteAction::make(),
        ];
    }
}
