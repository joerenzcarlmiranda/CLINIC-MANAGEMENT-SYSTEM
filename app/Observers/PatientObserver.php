<?php

namespace App\Observers;

use App\Models\Patient;
use Filament\Notifications\Notification;

class PatientObserver
{
    public function created(Patient $patient): void
    {
        Notification::make()
            ->title('Patient Added')
            ->body("{$patient->full_name} has been added.")
            ->success()
            ->sendToDatabase(auth()->user());
    }

    public function updated(Patient $patient): void
    {
        Notification::make()
            ->title('Patient Updated')
            ->body("{$patient->full_name} has been updated.")
            ->info()
            ->sendToDatabase(auth()->user());
    }

    public function deleted(Patient $patient): void
    {
        Notification::make()
            ->title('Patient Deleted')
            ->body("{$patient->full_name} has been deleted.")
            ->danger()
            ->sendToDatabase(auth()->user());
    }
}
