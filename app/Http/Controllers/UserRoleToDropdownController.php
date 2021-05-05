<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\UserDropdown;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class UserRoleToDropdownController extends Controller
{
    /**
     * give a dropdown menu to user with specific role
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function giveDropdown(Request $request)
    {
        $this->validate($request, [
            "role"                   => "required|string",
            "navigation_dropdown_id" => "required|integer",
        ]);

        $users = User::role($request->role)->get();

        if (!$users) {
            return response(["message" => "Users data not found please check the role"], Response::HTTP_NOT_FOUND);
        }

        $users->map(function ($user) use ($request) {
            UserDropdown::updateOrCreate(['user_id' => $user->id, 'navigation_dropdown_id' => $request->navigation_dropdown_id]);
        });

        return response(["message" => "Success to give users dropdown menu "]);
    }

    
    /**
     * revoke a dropdown menu from users
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function revokeDropdown(Request $request)
    {
        $this->validate($request, [
            "role"                   => "required|string",
            "navigation_dropdown_id" => "required|integer",
        ]);

        $users = User::role($request->role)->get();

        if (!$users) {
            return response(["message" => "User data not found please check the role"], Response::HTTP_NOT_FOUND);
        }

        $users->map(function ($user) use ($request) {
            UserDropdown::where("user_id", $user->id)
                ->where("navigation_dropdown_id", $request->navigation_dropdown_id)
                ->delete();
        });

        return response(["message" => "Success to remove dropdown users"]);
    }
}
