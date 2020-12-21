<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\EmployeeJobDescription;
use Faker;

class EmployeeJobDescriptionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $faker = Faker\Factory::create();
        for($i = 0; $i < 28; $i++){
            EmployeeJobDescription::create([
                'workplace' => $faker->word,
                'job_description' => $faker->sentences($nb = 1, $asText = true),
                'skills' => $faker->sentences($nb = 1, $asText = true),
                'employee_id' => $i+1,
                'sector_id' => rand(1, 4),
            ]);
        }
    }
}
