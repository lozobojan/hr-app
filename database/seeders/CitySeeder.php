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
        $name = ['Podgorica', 'Nikšić', 'Budva', 'Danilovgrad'];
        for($i = 0; $i<4; $i++){
            City::create([
                'name' => $name[$i],
            ]);
        }
    }
}
