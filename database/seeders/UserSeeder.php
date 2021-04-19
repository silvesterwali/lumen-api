<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        User::createMany([
            [
                "name"=>"super-admin",
                "email"=>"super-admin@gmail.com",
                "password"=>app("hash")->make("supersecret"),
                "verified_email"=>true
            ],
            [
                "name"=>"admin",
                "email"=>"admin@gmail.com",
                "password"=>app("hash")->make("supersecret"),
                "verified_email"=>true
            ]
        ]);
    }
}
