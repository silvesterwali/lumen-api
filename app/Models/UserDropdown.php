<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class UserDropdown extends Model
{
    protected $fillable = ["user_id", "navigation_dropdown_id"];

    public function user()
    {
        return $this->belongsTo(User::class, "user_id");
    }

    public function navigationDropdown()
    {
        return $this->belongsTo(NavigationDropdown::class);
    }
}
