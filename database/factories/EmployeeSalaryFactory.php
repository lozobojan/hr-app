<?php

namespace Database\Factories;

use App\Models\EmployeeSalary;
use Illuminate\Database\Eloquent\Factories\Factory;

class EmployeeSalaryFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = EmployeeSalary::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'pay' => $this->faker->numberBetween($min = 100, $max = 9000),
            'bonus' => $this->faker->numberBetween($min = 10, $max = 90),
            'bank_name' => $this->faker->company,
            'bank_number' => $this->faker->bankAccountNumber,

            'employee_id' => \App\Models\Employee::factory(),


        ];
    }
}
