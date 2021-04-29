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
                "name"       => "create-role",
                "guard_name" => "api",
            ],
            [
                "name"       => "edit-role",
                "guard_name" => "api",
            ],
            [
                "name"       => "delete-role",
                "guard_name" => "api",
            ],
            [
                "name"       => "create-navigation-drawer",
                "guard_name" => "api",
            ],
            [
                "name"       => "edit-navigation-drawer",
                "guard_name" => "api",
            ],
            [
                "name"       => "delete-navigation-drawer",
                "guard_name" => "api",
            ],
            [
                "name"       => "create-navigation-drawer-child",
                "guard_name" => "api",
            ],
            [
                "name"       => "edit-navigation-drawer-child",
                "guard_name" => "api",
            ],
            [
                "name"       => "delete-navigation-drawer-child",
                "guard_name" => "api",
            ],
            [
                "name"       => "give-permission",
                "guard_name" => "api",
            ],
            [
                "name"       => "revoke-permission",
                "guard_name" => "api",
            ],
            [
                "name"       => "give-role",
                "guard_name" => "api",
            ],
            [
                "name"       => "revoke-role",
                "guard_name" => "api",
            ],
        ]);
    }
}
