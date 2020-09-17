<?php

use App\Age;
use Illuminate\Database\Seeder;

class AgesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Age::insert([
            ['age' => '18-24'],
            ['age' => '25-30'],
            ['age' => '31-35'],
            ['age' => '40+'],
        ]);
    }
}
