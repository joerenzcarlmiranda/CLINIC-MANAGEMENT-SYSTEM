<?php

namespace App\Filament\Resources\Appointments\Pages;

use App\Actions\CreateAppointmentAction;
use App\Filament\Resources\Appointments\AppointmentResource;
use Filament\Actions\DeleteAction;
use Filament\Actions\ViewAction;
use Filament\Notifications\Notification;
use Filament\Resources\Pages\EditRecord;
use Illuminate\Database\Eloquent\Model;

class EditAppointment extends EditRecord
{
    protected static string $resource = AppointmentResource::class;

    protected function getHeaderActions(): array
    {
        return [
            ViewAction::make(),
            DeleteAction::make(),
        ];
    }

    protected function handleRecordUpdate(Model $record, array $data): Model
    {
        try {
            app(CreateAppointmentAction::class)->execute($data, excludeId: $record->id);
        } catch (\DomainException $e) {
            Notification::make()
                ->title('Schedule Conflict')
                ->body($e->getMessage())
                ->danger()
                ->send();

            $this->halt();
            throw $e;
        }

        $record->update($data);

        return $record;
    }
}
