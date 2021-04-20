<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Permission;

class PermissionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Permission::insert([
            [
                "name" => "create-module",
                "guard_name"=>"api"

            ], [
                "name" => "update-module",
                "guard_name"=>"api"
            ],
            ["name" => "delete-module",   "guard_name"=>"api"],
            [
                "name" => "create-news",
                "guard_name"=>"api"

            ],
            [
                "name" => "update-news",
                "guard_name"=>"api"

            ], 
            [
                "name" => "delete-news",
                "guard_name"=>"api"
            ],
        ]);
    }
}
