<?php

namespace Database\Seeders;

use App\Models\NavigationDropdown;
use Illuminate\Database\Seeder;

class NavigationDrawerSeed extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        NavigationDropdown::insert([
            [
                "name"        => "profile",
                "path_name"   => "/profile",
                "icon"        => "fa fa-user",
                "description" => "access profile ",
            ],
            [
                "name"        => "settings",
                "path_name"   => "/settings",
                "icon"        => "fa fa-cogs",
                "description" => "access setting ",
            ],
            [
                "name"        => "notify",
                "path_name"   => "/notify",
                "icon"        => "fa fa-bells",
                "description" => "access notify page ",
            ],
        ]);
    }
}
