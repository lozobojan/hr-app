<?php

namespace Database\Factories;

use App\Models\SalaryEmployeeHistory;
use Illuminate\Database\Eloquent\Factories\Factory;

class SalaryEmployeeHistoryFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = SalaryEmployeeHistory::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'employee_id' => \App\Models\Employee::factory(),
            'pay' => \App\Models\EmployeeSalary::factory()
        ];
    }
}
