<?php

use App\Admin;
use Illuminate\Database\Seeder;

class AdminsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $admins = [
            [
                'name' => 'Kimani Macharia',
                'email'          => 'kim@gmail.com',
                'phone'          => '254712345678',
                'password'       => bcrypt('password'),
                'remember_token' => null,
            ]
        ];

        Admin::insert($admins);
    }
}
