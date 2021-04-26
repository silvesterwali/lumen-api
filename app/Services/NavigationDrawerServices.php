<?php
namespace App\Services;

use App\Models\NavigationDrawer;

class NavigationDrawerServices
{
    /**
     * get max level from navigation drawer table
     * @return int
     */
    public function lastMaxLevel()
    {
        $maxLevel = NavigationDrawer::max("level");
        return $maxLevel + 1;
    }

}
