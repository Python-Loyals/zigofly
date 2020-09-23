<?php

use App\Address;
use Illuminate\Database\Seeder;

class CountriesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $countries = [
            [
                'name_suffix' => null,
                'street_one' => '3636 Ashbury Rd, Ste B',
                'street_two' => null,
                'city' => 'Eagan',
                'state' => 'Minnesota, MN',
                'county' => null,
                'country' => 'United States',
                'zip_code' => '55122',
                'phone' => '651 538 6331',
            ],
            [
                'name_suffix' => 'c/o Zigofly',
                'street_one' => '25 Brunswick Street, Lok N Store Ltd',
                'street_two' => '(Provided space): 0798272066 (Your Kenyan Number)',
                'city' => 'Luton',
                'state' => null,
                'county' => 'Bedfordshire',
                'country' => 'United Kingdom',
                'zip_code' => '	LU2 0HF',
                'phone' => '079 505 22189',
            ]
        ];

        Address::insert($countries);
    }
}
