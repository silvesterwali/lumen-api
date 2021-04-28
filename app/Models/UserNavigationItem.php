<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class UserNavigationItem extends Model
{
    protected $fillable = ["user_id", "navigation_drawer_child_id"];
    public function users()
    {
        return $this->hasMany(User::class, "user_id");
    }
}
