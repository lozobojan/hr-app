<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\EmployeeJobDescription;

class EmployeeJobDescriptionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        for($i = 0; $i < 7; $i++){
            EmployeeJobDescription::create([
                'workplace' => $this->faker->word,
                'job_description' => $this->faker->sentences($nb = 1, $asText = true),
                'skills' => $this->faker->sentences($nb = 1, $asText = true),
                'employee_id' => $i+1,
                'sector_id' => rand(1, 4),
            ]);
        }
    }
}
