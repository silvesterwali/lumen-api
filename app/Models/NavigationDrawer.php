<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class NavigationDrawer extends Model
{
    protected $fillable = ["name", "path_name", "icon", "description", "level"];

    public function navigation_drawer_child()
    {
        return $this->hasMany(NavigationDrawerChild::class, "navigation_drawer_id");
    }
}
