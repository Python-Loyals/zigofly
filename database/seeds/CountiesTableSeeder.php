<?php

use App\County;
use Illuminate\Database\Seeder;

class CountiesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $counties = [
            ['name'         => 'Baringo'],
            ['name'           => 'Bomet'],
            ['name'         => 'Bungoma'],
            ['name'           => 'Busia'],
            ['name' => 'Elgeyo-Marakwet'],
            ['name'            => 'Embu'],
            ['name'         => 'Garissa'],
            ['name'        => 'Homa-bay'],
            ['name'          => 'Isiolo'],
            ['name'         => 'Kajiado'],
            ['name'        => 'Kakamega'],
            ['name'         => 'Kericho'],
            ['name'          => 'Kiambu'],
            ['name'          => 'Kilifi'],
            ['name'       => 'Kirinyaga'],
            ['name'           => 'Kisii'],
            ['name'          => 'Kisumu'],
            ['name'           => 'Kitui'],
            ['name'           => 'Kwale'],
            ['name'        => 'Laikipia'],
            ['name'            => 'Lamu'],
            ['name'        => 'Machakos'],
            ['name'         => 'Makueni'],
            ['name'         => 'Mandera'],
            ['name'        => 'Marsabit'],
            ['name'            => 'Meru'],
            ['name'          => 'Migori'],
            ['name'         => 'Mombasa'],
            ['name'         => 'Muranga'],
            ['name'         => 'Nairobi'],
            ['name'          => 'Nakuru'],
            ['name'           => 'Nandi'],
            ['name'           => 'Narok'],
            ['name'         => 'Nyamira'],
            ['name'       => 'Nyandarua'],
            ['name'           => 'Nyeri'],
            ['name'         => 'Samburu'],
            ['name'           => 'Siaya'],
            ['name'    => 'Taita-Taveta'],
            ['name'      => 'Tana River'],
            ['name'   => 'Tharaka-Nithi'],
            ['name'     => 'Trans-Nzoia'],
            ['name'         => 'Turkana'],
            ['name'     => 'Uasin Gishu'],
            ['name'          => 'Vihiga'],
            ['name'           => 'Wajir'],
            ['name'      => 'West Pokot'],
        ];

        County::insert($counties);
    }
}
