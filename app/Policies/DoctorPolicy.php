<?php

namespace App\Policies;

use App\Models\User;

class DoctorPolicy
{
    public function viewAny(User $user): bool
    {
        return $user->can('doctor.viewAny');
    }

    public function view(User $user): bool
    {
        return $user->can('doctor.view');
    }

    public function create(User $user): bool
    {
        return $user->can('doctor.create');
    }

    public function update(User $user): bool
    {
        return $user->can('doctor.update');
    }

    public function delete(User $user): bool
    {
        return $user->can('doctor.delete');
    }
}
