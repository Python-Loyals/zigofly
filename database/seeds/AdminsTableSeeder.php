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
                'name' => 'Leah Wambui',
                'email'          => 'admin@admin.com',
                'phone'          => '254712345679',
                'password'       => bcrypt('password'),
                'remember_token' => null,
            ]
        ];

        Admin::insert($admins);
    }
}
