<?php

namespace Database\Seeders;

use App\Models\Employee;
use Illuminate\Database\Seeder;

class EmployeeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        
        $employee = new Employee();
        $employee->name = 'Radule';
        $employee->last_name = 'Bulatovic';
        $employee->image_path = 'https://picsum.photos/seed/picsum/80/80';
        $employee->save();

        $employee1 = new Employee();
        $employee1->name = 'Marko';
        $employee1->last_name = 'Bulatovic';
        $employee1->pid = 1;
        $employee1->image_path = 'https://picsum.photos/seed/picsum/80/80';
        $employee1->save();

        $employee2 = new Employee();
        $employee2->name = 'Radule';
        $employee2->last_name = 'Bulatovic';
        $employee2->pid = 2;
        $employee2->image_path = 'https://picsum.photos/seed/picsum/80/80';
        $employee2->save();

        $employee3 = new Employee();
        $employee3->name = 'Radule';
        $employee3->last_name = 'Bulatovic';
        $employee3->pid = 1;
        $employee3->image_path = 'https://picsum.photos/seed/picsum/80/80';
        $employee3->save();

        $employee4 = new Employee();
        $employee4->name = 'Radule';
        $employee4->last_name = 'Bulatovic';
        $employee4->pid = 1;
        $employee4->image_path = 'https://picsum.photos/seed/picsum/80/80';
        $employee4->save();
    }
}
