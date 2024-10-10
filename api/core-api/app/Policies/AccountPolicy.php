<?php

namespace App\Policies;

use App\Models\User;
use Illuminate\Auth\Access\HandlesAuthorization;
use Illuminate\Auth\Access\Response;
use Illuminate\Support\Facades\Auth;

class AccountPolicy
{
    use HandlesAuthorization;

    public function getAccountInformation(User $user): bool
    {
        return Auth::user()->id == $user->id;
    }

    public function updateAccountInformation(User $user): bool
    {
        return Auth::user()->id === $user->id;
    }


    public function updatePassword(User $user): bool
    {
        return Auth::user()->id === $user->id;
    }

    public function updateEmail(User $user): bool
    {
        return Auth::user()->id === $user->id;
    }
}
