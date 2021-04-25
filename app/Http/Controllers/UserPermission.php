<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;

class UserPermission extends Controller
{
    public function UserGivePermissionTo(Request $request)
    {
        $this->validate($request, [
            "user_id" => "required",
            "permission" => "required",
        ]);

        $user = User::findOrFail($request->user_id);
        $user->givePermissionTo($request->permission);
    }
}
