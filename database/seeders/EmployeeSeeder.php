<?php

namespace Database\Seeders;

use App\Models\EmployeeSalary;
use Illuminate\Database\Seeder;
use App\Models\Employee;

class EmployeeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $count = 20;
        Employee::factory()->count($count)->create()->each(function ($user) {
            //create 5 posts for each user
            EmployeeSalary::factory()->count(1)->create(['employee_id'=>$user->id]);
        });
    }
}
