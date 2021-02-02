<?php

namespace Database\Factories;

use App\Models\CityEmployeeHistory;
use Illuminate\Database\Eloquent\Factories\Factory;

class CityEmployeeHistoryFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = CityEmployeeHistory::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'employee_id' => function() {
                return factory(App\Models\Employee::class)->create()->id;
            },
            'city_id' => function() {
                return factory(App\Models\Employee::class)->create()->city_id;
            },
        ];
    }
}
