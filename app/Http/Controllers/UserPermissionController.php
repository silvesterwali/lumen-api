<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;

class UserPermissionController extends Controller
{
    /**
     * give permissions to a user
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function userGivePermissionTo(Request $request)
    {
        $this->validate($request, [
            "user_id" => "required",
            "permission" => "required",
        ]);

        $user = User::findOrFail($request->user_id);
        $user->givePermissionTo($request->permission);

        return response(["message" => "Success add permission to user"]);
    }

    /**
     * revoke a permission from a user
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function userRevokePermissionTo(Request $request)
    {
        $this->validate($request, [
            "user_id" => "required",
            "permission" => "required",
        ]);

        $user = User::findOrFail($request->user_id);
        $user->revokePermissionTo($request->permission);

        return response(["message" => "success to revoke a permission from a user"]);
    }

}
