<?php

namespace App\Filament\Resources\Consultations\Pages;

use App\Actions\CreateConsultationAction;
use App\Filament\Resources\Consultations\ConsultationResource;
use App\Models\Consultation;
use Filament\Actions\DeleteAction;
use Filament\Actions\ViewAction;
use Filament\Notifications\Notification;
use Filament\Resources\Pages\EditRecord;
use Illuminate\Database\Eloquent\Model;

class EditConsultation extends EditRecord
{
    protected static string $resource = ConsultationResource::class;

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
            return app(CreateConsultationAction::class)->execute($data, $record);
        } catch (\DomainException $e) {
            Notification::make()
                ->title('Cannot Update Consultation')
                ->body($e->getMessage())
                ->danger()
                ->send();

            $this->halt();
            throw $e;
        }
    }
}
