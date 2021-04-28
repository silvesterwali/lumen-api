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
        $userNavItem = NavigationDrawer::whereHas('navigation_drawer_child', function ($q) use ($user_id) {
            $q->whereHas(
                'userNavigationItems', function ($q2) use ($user_id) {
                    $q2->where('user_id', $user_id);
                },

            );
        })->with('navigation_drawer_child')->get();

        return response($userNavItem);
    }
}
