<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\City;
use Faker;

class CitySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $name = [
            'Podgorica',
            'Nikšić',
            'Pljevlja',
            'Bijelo polje',
            'Cetinje',
            'Bar',
            'Herceg Novi',
            'Berane',
            'Budva',
            'Ulcinj',
            'Tivat',
            'Rožaje',
            'Kotor',
            'Danilovgrad',
            'Mojkovac',
            'Plav',
            'Kolašin',
            'Žabljak',
            'Plužine',
            'Andrijevica',
            'Šavnik',
        ];
        $number_of_cities = count($name);
        for($i = 0; $i<count($name); $i++){
            City::create([
                'name' => $name[$i],
            ]);
        }
    }
}
