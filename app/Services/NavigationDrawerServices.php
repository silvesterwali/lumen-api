<?php
namespace Services;

use App\Models\NavigationDrawer;

class NavigationDrawerService
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
