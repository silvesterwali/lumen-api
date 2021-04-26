<?php

namespace App\Services;

use App\Models\NavigationDrawerChild;

class NavigationDrawerChildServices
{

    /**
     * get max level on navigation drawer child via main navigation drawer id
     * @return int
     */
    public function maxLevel($navigation_drawer_id)
    {
        $maxLevel = NavigationDrawerChild::where("navigation_drawer_id", $navigation_drawer_id)->max("level");

        return $maxLevel + 1;
    }
}
