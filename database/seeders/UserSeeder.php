<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        User::insert([
            [
                "name"           => "super-admin",
                "email"          => "super-admin@gmail.com",
                "password"       => app("hash")->make("supersecret"),
                "verified_email" => true,
            ],
            [
                "name"           => "admin",
                "email"          => "admin@gmail.com",
                "password"       => app("hash")->make("supersecret"),
                "verified_email" => true,
            ],
            [
                "name"           => "client",
                "email"          => "client@gmail.com",
                "password"       => app("hash")->make("supersecret"),
                "verified_email" => true,
            ],
        ]);
    }
}
