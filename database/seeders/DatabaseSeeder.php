<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $this->call(
            [
                UserSeeder::class,
                RoleSeeder::class,
                PermissionSeeder::class,
                UserRoleSeeder::class,
                NavigationSeeder::class,
                NavigationDropdownSeed::class,
            ]
        );
    }
}
