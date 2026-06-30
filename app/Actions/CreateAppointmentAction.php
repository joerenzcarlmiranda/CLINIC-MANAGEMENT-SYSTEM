<?php

namespace App\Actions;

use App\Enums\AppointmentStatusEnum;
use App\Models\Appointment;
use Illuminate\Support\Facades\Auth;

class CreateAppointmentAction
{
    /**
     * Create or update an appointment, enforcing that no two confirmed
     * appointments share the same doctor, date, and time.
     *
     * @param  string|null  $excludeId  UUID of the record being edited (prevents self-conflict)
     */
    public function execute(array $data, ?string $excludeId = null): Appointment
    {
        $conflict = Appointment::query()
            ->where('doctor_id', $data['doctor_id'])
            ->where('appointment_date', $data['appointment_date'])
            ->where('appointment_time', $data['appointment_time'])
            ->where('status', AppointmentStatusEnum::Confirmed)
            ->when($excludeId, fn ($q) => $q->whereNot('id', $excludeId))
            ->exists();

        if ($conflict) {
            throw new \DomainException(
                'The doctor already has a confirmed appointment at this date and time.'
            );
        }

        $data['created_by'] = Auth::id();

        return Appointment::create($data);
    }
}
