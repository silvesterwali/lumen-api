<?php

namespace Database\Seeders;

use App\Models\NavigationDrawer;
use App\Models\NavigationDrawerChild;
use Faker\Factory as Faker;
use Illuminate\Database\Seeder;

class NavigationSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $faker = Faker::create();

        foreach (["home", "dashboard", "profile", "user"] as $index) {
            $navDrawer = NavigationDrawer::create([
                "name"        => "/" . $index,
                "path_name"   => "/" . $index,
                "description" => $faker->catchPhrase(),
            ]);
            foreach (["edit", "update", "create", "delete"] as $value) {
                NavigationDrawerChild::create([
                    "navigation_drawer_id" => $navDrawer->id,
                    "name"                 => $index . " " . $value,
                    "path_name"            => "/" . $value,
                    "description"          => $faker->catchPhrase(),
                ]);
            }
        }
    }
}
