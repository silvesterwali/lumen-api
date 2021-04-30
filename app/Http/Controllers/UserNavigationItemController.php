<?php

namespace App\Http\Controllers;

use App\Models\NavigationDrawer;

class UserNavigationItemController extends Controller
{
    /**
     * get all user navigation items
     * @param int $user_id
     * @return \Illuminate\Http\Response
     */
    public function __invoke($user_id)
    {
        $userNavItem = NavigationDrawer::with(
            ["navigation_drawer_child" => function ($q) use ($user_id) {
                // get relationship table with condition
                $q->whereHas("userNavigationItems", function ($qq) use ($user_id) {

                    $qq->where("user_id", $user_id)

                        ->orderBy("level", "asc");

                });
            },
            ]
        )

            ->whereHas("navigation_drawer_child", function ($q) use ($user_id) {
                // if current relationship is empty whereHas will reduce to prevent return data
                // without any data on relationship eager loading
                $q->whereHas("userNavigationItems", function ($qq) use ($user_id) {

                    $qq->where("user_id", $user_id)

                        ->orderBy("level", "asc");

                });
            })
            ->orderBy('level', "asc")
            ->get();

        return response($userNavItem);
    }
}
