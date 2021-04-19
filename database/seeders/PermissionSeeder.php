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
        Permission::createMany([
            [
            "name"=>"create-module",
            "name"=>"update-module",
            "name"=>"delete-module"
        ],
        [
            "name"=>"create-news",
            "name"=>"update-news",
            "name"=>"delete-news"
        ]
        ]);
    }
}
