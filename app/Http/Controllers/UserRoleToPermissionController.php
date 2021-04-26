<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class UserRoleToPermissionController extends Controller
{
    /**
     * all user with specific role give permission to
     * @param \Illuminate\Http\Request #$request
     * @return \Illuminate\Http\Response
     */
    public function userRoleGivePermissionTo(Request $request)
    {

        $this->validate($request, [
            "role"       => "required",
            "permission" => "required",
        ]);

        $users = User::role($request->role)->get();

        if (!$users) {
            return response(["message" => "User with given role not found"], Response::HTTP_UNPROCESSABLE_ENTITY);
        }

        foreach ($users as $user) {

            $currentUser = User::find($user->id);
            $currentUser->givePermissionTo($request->permission);
        }

        return response(["message" => "Success to add a permission to specific user with via role "]);
    }

    /**
     * revoke a permission from user with specific role
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function userRoleRevokePermissionTo(Request $request)
    {
        $this->validate($request, [
            "role"       => "required",
            "permission" => "required",
        ]);

        $users = User::role($request->role)
            ->get();

        if (!$users) {
            return response(["message" => "User with given role not found"], Response::HTTP_UNPROCESSABLE_ENTITY);
        }

        foreach ($users as $user) {

            $currentUser = User::find($user->id);
            $currentUser->revokePermissionTo($request->permission);
        }

        return response(["message" => "Success to revoke a permission from user via role "]);
    }
}
