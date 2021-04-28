<?php

namespace App\Http\Controllers;

use App\Models\UserNavigationItem;
use Illuminate\Http\Request;

class UserNavigationController extends Controller
{
    /**
     * give a user a navigation
     * @param \Illuminate\Http\Request $request
     * @param \Illuminate\Http\Response
     */
    public function giveNavigationToUser(Request $request)
    {
        $this->validate($request, [
            "user_id"                    => "required",
            "navigation_drawer_child_id" => "required",
        ]);

        UserNavigationItem::updateOrCreate($request->only(['user_id', 'navigation_drawer_child_id']));

        return response(["message" => "Success provides user navigation"]);
    }

    /**
     * remove user navigation according user_id and navigation_drawer_child_id
     * @param \Illuminate\Http\Request
     * @return \Illuminate\Http\Response
     */
    public function revokeNavigationFromUser(Request $request)
    {
        $this->validate($request, [
            "user_id"                    => "required",
            "navigation_drawer_child_id" => "required",
        ]);

        UserNavigationItem::where("user_id", $request->user_id)
            ->where("navigation_drawer_child_id", $request->navigation_drawer_child_id)
            ->delete();

        return response(['message' => "Successfully revoked user navigation"]);
    }

}
