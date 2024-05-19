<?php

namespace App\Policies;

use App\Models\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class UserPolicy
{
    use HandlesAuthorization;

    public function update(User $currentUser, User $user)
    {
        return $currentUser->id === $user->id || $currentUser->role === 'admin';
    }

    public function delete(User $currentUser, User $user)
    {
        return $currentUser->role === 'admin';
    }
}
