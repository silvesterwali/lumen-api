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

        foreach (range(1, 10) as $index) {
            $navDrawer = NavigationDrawer::create([
                "name"        => "/" . $faker->company(),
                "path_name"   => "/" . $faker->creditCardType(),
                "description" => $faker->catchPhrase(),
            ]);
            foreach (["edit", "update", "create", "delete"] as $value) {
                NavigationDrawerChild::create([
                    "navigation_drawer_id" => $navDrawer->id,
                    "name"                 => $faker->name(),
                    "path_name"            => "/" . $value,
                    "description"          => $faker->catchPhrase(),
                ]);
            }
        }
    }
}
