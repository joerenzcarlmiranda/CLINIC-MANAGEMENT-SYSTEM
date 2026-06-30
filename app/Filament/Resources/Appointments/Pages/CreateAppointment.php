<?php

namespace App\Filament\Resources\Appointments\Pages;

use App\Actions\CreateAppointmentAction;
use App\Filament\Resources\Appointments\AppointmentResource;
use Filament\Notifications\Notification;
use Filament\Resources\Pages\CreateRecord;
use Illuminate\Database\Eloquent\Model;

class CreateAppointment extends CreateRecord
{
    protected static string $resource = AppointmentResource::class;

    protected function handleRecordCreation(array $data): Model
    {
        try {
            return app(CreateAppointmentAction::class)->execute($data);
        } catch (\DomainException $e) {
            Notification::make()
                ->title('Schedule Conflict')
                ->body($e->getMessage())
                ->danger()
                ->send();

            $this->halt();
            throw $e;
        }
    }
}
