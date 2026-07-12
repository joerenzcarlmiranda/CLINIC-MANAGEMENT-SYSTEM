<?php

namespace App\Policies;

use App\Models\User;

class ConsultationPolicy
{
    public function viewAny(User $user): bool
    {
        return $user->can('consultation.viewAny');
    }

    public function view(User $user): bool
    {
        return $user->can('consultation.view');
    }

    public function create(User $user): bool
    {
        return $user->can('consultation.create');
    }

    public function update(User $user): bool
    {
        return $user->can('consultation.update');
    }

    public function delete(User $user): bool
    {
        return $user->can('consultation.delete');
    }
}
