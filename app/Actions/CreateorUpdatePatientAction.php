<?php

namespace App\Actions;

use App\Enums\RoleEnum;
use App\Models\Patient;
use App\Models\User;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\DB;

class CreateorUpdatePatientAction
{
    public function execute(array $data, ?Patient $patient = null): Patient
    {
        return DB::transaction(function () use ($data, $patient) {

            $user = $patient?->user;

            $patientData = Arr::except(
                $data,
                ['email', 'password', 'password_confirmation']
            );

            $userData = [
                'name' => trim(
                    ($data['first_name'] ?? '').' '.
                    ($data['last_name'] ?? '')
                ),
            ];

            if (! empty($data['email'])) {

                $userData['email'] = $data['email'];

                // Only set password if provided
                if (! empty($data['password'])) {
                    $userData['password'] = $data['password']; // no bcrypt()
                }

                if ($user) {
                    $user->update($userData);
                } else {
                    $user = User::create($userData);
                }

                if (! $user->hasRole(RoleEnum::PATIENT->value)) {
                    $user->assignRole(RoleEnum::PATIENT->value);
                }
            } elseif ($user) {
                // Update name when first/last name changes
                $user->update($userData);
            }

            $patientData['user_id'] = $user?->id;

            if ($patient) {
                $patient->update($patientData);

                return $patient->fresh('user');
            }

            return Patient::create($patientData);
        });
    }
}
