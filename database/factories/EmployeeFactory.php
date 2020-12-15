<?php

namespace Database\Factories;

use App\Models\Employee;
use Illuminate\Database\Eloquent\Factories\Factory;

class EmployeeFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Employee::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'name' => $this->faker->firstNameMale,
            'last_name' => $this->faker->lastName,
            'image' => "https://source.unsplash.com/600x600/?nature,water",
            'birth_date' => $this->faker->date($format = 'd.m.Y.', $max = 'now'),
            'qualifications' => $this->faker->word,
            'home_address' => $this->faker->address,
            'jmbg' => $this->faker->ean13,
            'additional_info' => $this->faker->realText($maxNbChars = 200, $indexSize = 2),
            'email' => $this->faker->freeEmail,
            'mobile_number' => $this->faker->e164PhoneNumber,
            'telephone_number' => $this->faker->phoneNumber,
            'office_number' => $this->faker->numberBetween($min = 1, $max = 12),
            'additional_info_contact' => $this->faker->realText($maxNbChars = 200, $indexSize = 2)
        ];
    }
}
