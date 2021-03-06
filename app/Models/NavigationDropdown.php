<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class NavigationDropdown extends Model
{
    protected $fillable = ["name", "path_name", "level", "icon", "description"];

    public function userDropdown()
    {
        return $this->hasMany(UserDropdown::class, "navigation_dropdown_id");
    }

    public static function boot()
    {
        parent::boot();

        // auto increment the level while inserting data
        NavigationDropdown::creating(function ($model) {

            $model->level = NavigationDropdown::max('level') + 1;

        });
    }
}
