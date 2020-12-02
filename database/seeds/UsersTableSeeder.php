<?php

use App\Age;
use App\User;
use Illuminate\Database\Seeder;

class UsersTableSeeder extends Seeder
{
    public function run()
    {
        $users = [
            [
                'id'             => 1,
                'name'           => 'Admin',
                'email'          => 'customer@customer.com',
                'phone'          => '254712345678',
                'password'       => bcrypt('password'),
                'remember_token' => null,
                'age'            => 1,
                'county'         => 1
            ],
        ];

        User::insert($users);
    }
}
