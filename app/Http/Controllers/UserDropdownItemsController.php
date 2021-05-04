<?php

namespace App\Http\Controllers;

use App\Models\NavigationDropdown;

class UserDropdownItemsController extends Controller
{
    /**
     * @param int $user_id
     * @return \Illuminate\Http\Response
     */
    public function __invoke($user_id)
    {
        $navigationDropdown = NavigationDropdown::whereHas("userDropdown", function ($query) use ($user_id) {
            $query->where("user_id", $user_id);
        })->orderBy("level", "asc")
            ->get();

        return response($navigationDropdown);
    }
}
