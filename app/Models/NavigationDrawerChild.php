<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class NavigationDrawerChild extends Model
{
    protected $table    = 'navigation_drawer_child';
    protected $fillable = ["name", "navigation_drawer_id", "path_name", "icon", "level", "description"];
    protected $hidden   = ["created_at", "updated_at"];

    public function navigation_drawer()
    {
        return $this->belongsTo(NavigationDrawer::class, "id");
    }

    public function userNavigationItems()
    {
        return $this->hasMany(UserNavigationItem::class, "navigation_drawer_child_id");
    }

    protected static function boot()
    {
        parent::boot();

        NavigationDrawerChild::creating(function ($model) {

            // access max on same navigation drawer id

            $model->level = NavigationDrawerChild::where("navigation_drawer_id", $model->navigation_drawer_id)
                ->max('level') + 1;
        });
    }

}
