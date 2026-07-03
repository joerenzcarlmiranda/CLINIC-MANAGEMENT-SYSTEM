<?php

namespace App\Actions;

use App\Models\Consultation;
use App\Models\Prescription;

class CreatePrescriptionAction
{
    public function execute(array $data, ?Prescription $prescription = null): Prescription
    {
        $consultation = Consultation::findOrFail($data['consultation_id']);

        if (! $consultation->appointment) {
            throw new \DomainException('The consultation is not linked to a valid appointment.');
        }

        if ($prescription) {
            $prescription->update($data);

            return $prescription->fresh();
        }

        return Prescription::create($data);
    }
}
