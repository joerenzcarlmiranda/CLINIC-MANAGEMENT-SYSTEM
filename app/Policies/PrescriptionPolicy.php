<?php

namespace App\Policies;

use App\Models\User;

class PrescriptionPolicy
{
    public function viewAny(User $user): bool
    {
        return $user->can('prescription.viewAny');
    }

    public function view(User $user): bool
    {
        return $user->can('prescription.view');
    }

    public function create(User $user): bool
    {
        return $user->can('prescription.create');
    }

    public function update(User $user): bool
    {
        return $user->can('prescription.update');
    }

    public function delete(User $user): bool
    {
        return $user->can('prescription.delete');
    }
}
