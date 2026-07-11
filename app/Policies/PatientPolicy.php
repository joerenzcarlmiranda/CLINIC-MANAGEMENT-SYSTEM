<?php

namespace App\Policies;

use App\Enums\RoleEnum;
use App\Models\User;

class PatientPolicy
{
    public function viewAny(User $user): bool
    {
        return $user->can('patient.viewAny');
    }

    public function view(User $user): bool
    {
        return $user->can('patient.view');
    }

    public function create(User $user): bool
    {
        return $user->can('patient.create');
    }

    public function update(User $user): bool
    {
        return $user->can('patient.update');
    }

    public function delete(User $user): bool
    {
        return $user->can('patient.delete');
    }
}
