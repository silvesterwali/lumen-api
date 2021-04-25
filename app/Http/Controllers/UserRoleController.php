<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;

class UserRoleController extends Controller
{
    /**
     * assign a role to user
     * @param \Illuminate\Http\Request $request
     * @param \Illuminate\Http\Response
     */
    public function userAssignRole(Request $request)
    {
        $this->validate($request, [
            "user_id" => "required",
            "role" => "required",
        ]);

        $user = User::findOrFail($request->user_id);

        $user->assignRole($request->role);

        return response(["message" => "Success to assign role to a user"]);

    }
}
