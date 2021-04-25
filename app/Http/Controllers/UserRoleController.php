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

    /**
     * remove a role from a user
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Request
     */
    public function userRemoveRoleAs(Request $request)
    {
        $this->validate($request, [
            "user_id" => "required",
            "role" => "required",
        ]);

        $user = User::findOrFail($request->user_id);
        $user->removeRole($request->role);

        return response(["message" => "Success to remove role from user"]);
    }

    /**
     * get users with a role
     * @param string $role
     * @return \Illuminate\Http\Response
     */
    public function usersWithRole($role)
    {
        $users = User::role($role)->paginate(50);

        return response($users);
    }

    /**
     * get users with any role
     * @return \Illuminate\Http\Response
     */
    public function usersWithoutRole()
    {
        $users = User::doesntHave("roles")->paginate(50);

        return response($users);
    }
}
