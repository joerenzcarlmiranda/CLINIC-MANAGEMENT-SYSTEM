<?php

namespace App\Filament\Resources\Prescriptions\Pages;

use App\Actions\CreatePrescriptionAction;
use App\Filament\Resources\Prescriptions\PrescriptionResource;
use Filament\Notifications\Notification;
use Filament\Resources\Pages\CreateRecord;
use Illuminate\Database\Eloquent\Model;

class CreatePrescription extends CreateRecord
{
    protected static string $resource = PrescriptionResource::class;

    protected function handleRecordCreation(array $data): Model
    {
        try {
            return app(CreatePrescriptionAction::class)->execute($data);
        } catch (\DomainException $e) {
            Notification::make()
                ->title('Cannot Create Prescription')
                ->body($e->getMessage())
                ->danger()
                ->send();

            $this->halt();
            throw $e;
        }
    }
}
