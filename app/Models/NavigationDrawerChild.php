<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class NavigationDrawerChild extends Model
{
    protected $fillable = ["name", "navigation_drawer_id", "path_name", "icon", "level", "description"];

    public function navigation_drawer()
    {
        return $this->belongsTo(NavigationDrawer::class, "id");
    }
}
