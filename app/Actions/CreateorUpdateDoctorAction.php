<?php

namespace App\Actions;

use App\Enums\RoleEnum;
use App\Models\Doctor;
use App\Models\User;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\DB;

class CreateorUpdateDoctorAction
{
    /**
     * Create or update a doctor and their associated user account.
     */
    public function execute(array $data, ?Doctor $doctor = null): Doctor
    {
        return DB::transaction(function () use ($data, $doctor) {
            // 1. Prepare User Data
            $userData = [
                'name' => trim(($data['first_name'] ?? '').' '.($data['last_name'] ?? '')),
            ];

            if (! empty($data['email'])) {
                $userData['email'] = $data['email'];
            }

            if (! empty($data['password'])) {
                $userData['password'] = $data['password']; // Laravel casts automatically hash this if configured
            }

            // 2. Create or Update the User
            if ($doctor && $doctor->user) {
                $user = $doctor->user;
                $user->update($userData);
            } else {
                // Only require email when creating a new user
                $user = User::create($userData);
                $user->assignRole(RoleEnum::DOCTOR->value);
            }

            // 3. Prepare Doctor Data (exclude user-specific fields)
            $doctorData = Arr::except($data, ['email', 'password', 'password_confirmation']);
            $doctorData['user_id'] = $user->id;

            // 4. Create or Update the Doctor
            if ($doctor) {
                $doctor->update($doctorData);
            } else {
                $doctor = Doctor::create($doctorData);
            }

            return $doctor;
        });
    }
}
