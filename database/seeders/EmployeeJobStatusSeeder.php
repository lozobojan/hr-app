<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\EmployeeJobStatus;
use Faker;

class EmployeeJobStatusSeeder extends Seeder
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
            EmployeeJobStatus::create([
                'type' => $faker->numberBetween(1 , 4),
                'status' => $faker->sentences($nb = 1, $asText = true),
                'additional_info' => $faker->sentences($nb = 1, $asText = true),
                'date_hired' => $faker->date($format = 'Y-m-d', $max = 'now'),
                'employee_id' => $i+1,
            ]);
        }
    }
}
