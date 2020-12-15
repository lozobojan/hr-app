<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Employee;
use App\Models\EmployeeSalary;
use App\Models\EmployeeJobDescription;

class EmployeeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $count = [null, 1, 1, 2, 2, 3, 6, 5];
        for($i = 0; $i<7; $i++){
            $employee = Employee::factory();
            Employee::create([
                'name' => $employee->faker->firstNameMale,
                'last_name' => $employee->faker->lastName,
                'image_path' => $employee->faker->imageUrl($width = 200, $height = 200, 'person'),
                'birth_date' => $employee->faker->date($format = 'd.m.Y.', $max = 'now'),
                'qualifications' => $employee->faker->word,
                'home_address' => $employee->faker->address,
                'jmbg' => $employee->faker->ean13,
                'additional_info' => $employee->faker->realText($maxNbChars = 200, $indexSize = 2),
                'email' => $employee->faker->freeEmail,
                'mobile_number' => $employee->faker->e164PhoneNumber,
                'telephone_number' => $employee->faker->phoneNumber,
                'office_number' => $employee->faker->numberBetween($min = 1, $max = 12),
                'additional_info_contact' => $employee->faker->realText($maxNbChars = 200, $indexSize = 2),
                'pid' => $count[$i],
            ]);
            EmployeeSalary::factory()->create(['employee_id'=>$i+1]);
            EmployeeJobDescription::factory()->create(['employee_id'=>$i+1]);
        }
    }
}
