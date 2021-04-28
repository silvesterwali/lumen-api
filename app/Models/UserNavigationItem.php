<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class UserNavigationItem extends Model
{
    public function users()
    {
        return $this->hasMany(User::class, "user_id");
    }
}
