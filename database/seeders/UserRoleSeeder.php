<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Permission;

class UserRoleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $permission = Permission::pluck('name')->toArray();

        $superAdmin = User::find(1);
        $superAdmin->assignRole('Super Admin');
        $superAdmin->givePermissionTo($permission);

        $admin = User::find(2);
        $admin->assignRole("Admin");
        $admin->givePermissionTo($permission);
    }
}
