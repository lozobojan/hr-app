<?php

namespace Database\Factories;

use App\Models\EmployeeJobDescription;
use Illuminate\Database\Eloquent\Factories\Factory;

class EmployeeJobDescriptionFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = EmployeeJobDescription::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'workplace' => $this->faker->word,
            'job_description' => $this->faker->sentences($nb = 1, $asText = true),
            'skills' => $this->faker->sentences($nb = 1, $asText = true),
            'sector_id' => rand(1, 4),
        ];
    }
}
