<?php

namespace App\Observers;

use App\Models\CityEmployeeHistory;
use App\Models\SalaryEmployeeHistory;
use App\Models\Employee;

class EmployeeObserver
{
    /**
     * Handle the Employee "created" event.
     *
     * @param  \App\Models\Employee  $employee
     * @return void
     */
    public function created(Employee $employee)
    {
        //
    }

    /**
     * Handle the Employee "updated" event.
     *
     * @param  \App\Models\Employee  $employee
     * @return void
     */
    public function updated(Employee $employee)
    {

        if($employee->wasChanged('city_id')){
            CityEmployeeHistory::create(['employee_id' => $employee->id, 'city_id' => $employee->city_id]);
        }
        if($employee->employeeSalary->wasChanged('pay')){
            dd($employee);
            SalaryEmployeeHistory::create(['employee_id' => $employee->id, 'pay' => $employee->employeeSalary->pay, 'bonus' => $employee->employeeSalary->bonus]);
        }
    }

    /**
     * Handle the Employee "deleted" event.
     *
     * @param  \App\Models\Employee  $employee
     * @return void
     */
    public function deleted(Employee $employee)
    {
        //
    }

    /**
     * Handle the Employee "restored" event.
     *
     * @param  \App\Models\Employee  $employee
     * @return void
     */
    public function restored(Employee $employee)
    {
        //
    }

    /**
     * Handle the Employee "force deleted" event.
     *
     * @param  \App\Models\Employee  $employee
     * @return void
     */
    public function forceDeleted(Employee $employee)
    {
        //
    }
}
