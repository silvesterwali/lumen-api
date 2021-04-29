<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;

class RoleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Role::insert([
            [
                "name"       => "Super Admin",
                "guard_name" => "api",

            ],
            [
                "name"       => "Admin",
                "guard_name" => "api",
            ],
        ]);
    }
}
