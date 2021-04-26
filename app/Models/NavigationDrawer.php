<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class NavigationDrawer extends Model
{
    protected $fillable = ["name", "path_name", "icon", "description", "level"];
}
