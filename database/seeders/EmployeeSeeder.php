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
        $employee->birth_date = '2020-12-02';
        $employee->jmbg = '29020001919';
        $employee->qualifications = 'None';
        $employee->home_address = 'Radnom address';
        $employee->email = 'email@test.com';
        $employee->last_name = 'Bulatovic';
        $employee->image_path = 'https://picsum.photos/seed/picsum/80/80';
        $employee->save();

        $employee1 = new Employee();
        $employee1->name = 'Marko';
        $employee1->birth_date = '2020-12-02';
        $employee1->jmbg = '29020001919';
        $employee1->qualifications = 'None';
        $employee1->home_address = 'Radnom address';
        $employee1->email = 'email@test.com';
        $employee1->last_name = 'Bulatovic';
        $employee1->pid = 1;
        $employee1->image_path = 'https://picsum.photos/seed/picsum/80/80';
        $employee1->save();

        $employee2 = new Employee();
        $employee2->name = 'Radule';
        $employee2->birth_date = '2020-12-02';
        $employee2->jmbg = '29020001919';
        $employee2->qualifications = 'None';
        $employee2->home_address = 'Radnom address';
        $employee2->email = 'email@test.com';
        $employee2->last_name = 'Bulatovic';
        $employee2->pid = 2;
        $employee2->image_path = 'https://picsum.photos/seed/picsum/80/80';
        $employee2->save();

        $employee3 = new Employee();
        $employee3->name = 'Radule';
        $employee3->birth_date = '2020-12-02';
        $employee3->jmbg = '29020001919';
        $employee3->qualifications = 'None';
        $employee3->home_address = 'Radnom address';
        $employee3->email = 'email@test.com';
        $employee3->last_name = 'Bulatovic';
        $employee3->pid = 1;
        $employee3->image_path = 'https://picsum.photos/seed/picsum/80/80';
        $employee3->save();

        $employee4 = new Employee();
        $employee4->name = 'Radule';
        $employee4->birth_date = '2020-12-02';
        $employee4->jmbg = '29020001919';
        $employee4->qualifications = 'None';
        $employee4->home_address = 'Radnom address';
        $employee4->email = 'email@test.com';
        $employee4->last_name = 'Bulatovic';
        $employee4->pid = 1;
        $employee4->image_path = 'https://picsum.photos/seed/picsum/80/80';
        $employee4->save();
    }
}
