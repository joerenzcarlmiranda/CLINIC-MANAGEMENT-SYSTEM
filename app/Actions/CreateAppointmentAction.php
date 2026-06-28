<?php

namespace App\Actions;
use App\Models\Appointment;
use Illuminate\Support\Facades\Auth; 
class CreateAppointmentAction
{
    /**
     * Create a new class instance.
     */
    public function execute(array $data): Appointment
    {
        $conflict = Appointment::query()
        ->where('doctor_id',$data['doctor_id'])
        ->where('appointment_date',$data['appointment_date'])
        ->where('appointment_time',$data['appointment_time'])
        ->exists();

        if($conflict)
            {
                throw new \DomainException(
                    'Doctor already has an appointment during this schedule.'
                );
            }
        
        $data['created_by'] = Auth::id();
        return Appointment::create($data);
    }
}
