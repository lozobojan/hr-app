<?php

namespace Database\Factories;

use App\Models\EmployeeJobStatus;
use Illuminate\Database\Eloquent\Factories\Factory;

class EmployeeJobStatusFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = EmployeeJobStatus::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'type' => $this->faker->word,
            'status' => $this->faker->word,
            'date_hired' => "2020-01-01",
            'date_hired_till' => "2020-01-01",
            'additional_info' => $this->faker->word,

            'employee_id' => function() {
                return factory(App\Models\Employee::class)->create()->id;
            },
        ];
    }
}
