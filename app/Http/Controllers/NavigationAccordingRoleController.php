<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\UserNavigationItem;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use \Spatie\Permission\Models\Role;

class NavigationAccordingRoleController extends Controller
{
    /**
     * give a navigation to user's with a role
     * @param \Illuminate\Http\Request
     * @return \Illuminate\Http\Response
     */
    public function giveNavigationToRole(Request $request)
    {
        $this->validate($request, [
            "role"                       => "required|string",
            "navigation_drawer_child_id" => "required|integer",
        ]);

        $role = Role::findByName($request->role);

        if (!$role) {

            return response(["message" => "The role you are aiming for does not exist"], Response::HTTP_UNPROCESSABLE_ENTITY);
        }

        $users = User::role($request->role)->get();

        if (!$users) {
            return response(["message" => "There is no user data"], Response::HTTP_UNPROCESSABLE_ENTITY);
        }

        $users->map(function ($user) use ($request) {

            UserNavigationItem::updateOrCreate(
                [
                    "user_id"                    => $user->id,
                    "navigation_drawer_child_id" => $request->navigation_drawer_child_id,
                ],
                [
                    "user_id"                    => $user->id,
                    "navigation_drawer_child_id" => $request->navigation_drawer_child_id,
                ]
            );

        });

        return response(["message" => "Success provides navigation for users via role"]);
    }

    /**
     * revoke a navigation from user's with a role
     * @param \Illuminate\Http\Request;
     * @param \Illuminate\Http\Response
     */
    public function revokeNavigationFromRole(Request $request)
    {
        $this->validate($request, [
            "role"                       => "required|string",
            "navigation_drawer_child_id" => "required|integer",
        ]);

        $role = Role::findByName($request->role);

        if (!$role) {

            return response(["message" => "The role you are aiming for does not exist"], Response::HTTP_UNPROCESSABLE_ENTITY);
        }

        $users = User::role($request->role)->get();

        if (!$users) {
            return response(["message" => "There is no user data"], Response::HTTP_UNPROCESSABLE_ENTITY);
        }

        $users->map(function ($user) use ($request) {

            UserNavigationItem::where("user_id", $user->id)
                ->where("navigation_drawer_child_id", $request->navigation_drawer_child_id)
                ->delete();
        });

        return response(["message" => "Success provides navigation for users via role"]);
    }
}
