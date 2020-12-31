<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Employee;
use App\Models\EmployeeSalary;
use Faker;

class EmployeeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $count = [null, 1, 1, 2, 2, 3, 6, 5, 1, 2, 2, 3, 6, 5,null, 1, 1, 2, 2, 3, 6, 5, 1, 2, 2, 3, 6, 5,];
        for($i = 0; $i<28; $i++){
            $faker = Faker\Factory::create();
            Employee::create([
                'name' => $faker->firstNameMale,
                'last_name' => $faker->lastName,
                'image' => $faker->imageUrl($width = 200, $height = 200, 'person'),
                'birth_date' => $faker->date($format = 'd.m.Y.', $max = 'now'),
                'qualifications' => $faker->word,
                'home_address' => $faker->address,
                'jmbg' => $faker->ean13,
                'additional_info' => $faker->realText($maxNbChars = 20, $indexSize = 2),
                'email' => $faker->freeEmail,
                'mobile_number' => $faker->e164PhoneNumber,
                'telephone_number' => $faker->phoneNumber,
                'gender' => $faker->numberBetween($min = 0, $max = 1),
                'office_number' => $faker->numberBetween($min = 1, $max = 12),
                'additional_info_contact' => $faker->realText($maxNbChars = 20, $indexSize = 2),
                'pid' => $count[$i],
            ]);
            EmployeeSalary::factory()->create(['employee_id'=>$i+1]);
        }
    }
}
