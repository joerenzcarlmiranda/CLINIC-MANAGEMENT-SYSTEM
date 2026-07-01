<?php

namespace App\Filament\Resources\Consultations\Pages;

use App\Actions\CreateConsultationAction;
use App\Filament\Resources\Consultations\ConsultationResource;
use Filament\Notifications\Notification;
use Filament\Resources\Pages\CreateRecord;
use Illuminate\Database\Eloquent\Model;

class CreateConsultation extends CreateRecord
{
    protected static string $resource = ConsultationResource::class;

    protected function handleRecordCreation(array $data): Model
    {
        try {
            return app(CreateConsultationAction::class)->execute($data);
        } catch (\DomainException $e) {
            Notification::make()
                ->title('Cannot Create Consultation')
                ->body($e->getMessage())
                ->danger()
                ->send();

            $this->halt();
            throw $e;
        }
    }
}
