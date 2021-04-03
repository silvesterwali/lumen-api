<?php

namespace App\Policies;

use App\Models\User;
use Illuminate\Auth\Access\HandlesAuthorization;
use Illuminate\Auth\Access\Response;

class ModulePolicy
{
    use HandlesAuthorization;

    public function create(User $user)
    {
        dd($user);
        return $user->role === 0 ? Response::allow() : Response::deny(["message" => "Access forbidden . Only admin"]);
    }

}
