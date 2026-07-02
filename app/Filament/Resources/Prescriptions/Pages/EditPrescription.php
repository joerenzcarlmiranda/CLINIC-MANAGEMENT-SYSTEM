<?php

namespace App\Filament\Resources\Prescriptions\Pages;

use App\Actions\CreatePrescriptionAction;
use App\Filament\Resources\Prescriptions\PrescriptionResource;
use Filament\Actions\DeleteAction;
use Filament\Actions\ViewAction;
use Filament\Notifications\Notification;
use Filament\Resources\Pages\EditRecord;
use Illuminate\Database\Eloquent\Model;

class EditPrescription extends EditRecord
{
    protected static string $resource = PrescriptionResource::class;

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
            return app(CreatePrescriptionAction::class)->execute($data, $record);
        } catch (\DomainException $e) {
            Notification::make()
                ->title('Cannot Update Prescription')
                ->body($e->getMessage())
                ->danger()
                ->send();

            $this->halt();
            throw $e;
        }
    }
}
