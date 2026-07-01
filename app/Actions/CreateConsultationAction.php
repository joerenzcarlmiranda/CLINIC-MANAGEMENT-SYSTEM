<?php

namespace App\Actions;

use App\Enums\AppointmentStatusEnum;
use App\Models\Appointment;
use App\Models\Consultation;

class CreateConsultationAction
{
    public function execute(array $data, ?Consultation $consultation = null): Consultation
    {
        $appointment = Appointment::findOrFail($data['appointment_id']);

        if (! in_array($appointment->status, [AppointmentStatusEnum::Confirmed, AppointmentStatusEnum::Completed])) {
            throw new \DomainException(
                'A consultation can only be created for a Confirmed or Completed appointment.'
            );
        }

        if (! $consultation && $appointment->consultation()->exists()) {
            throw new \DomainException(
                'This appointment already has a consultation.'
            );
        }

        if ($consultation) {
            $consultation->update($data);

            return $consultation->fresh();
        }

        return Consultation::create($data);
    }
}
