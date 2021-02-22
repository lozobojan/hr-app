<?php

namespace App\Observers;

use App\Models\EmployeeSalary;
use App\Models\SalaryEmployeeHistory;

class EmployeeSalaryObserver
{
    /**
     * Handle the EmployeeSalary "created" event.
     *
     * @param  \App\Models\EmployeeSalary  $employeeSalary
     * @return void
     */
    public function created(EmployeeSalary $employeeSalary)
    {
        //
    }

    /**
     * Handle the EmployeeSalary "updated" event.
     *
     * @param EmployeeSalary $employee
     * @return void
     */
    public function updated(EmployeeSalary $employee)
    {

        if($employee->wasChanged('pay')){
            dd($employee);
            SalaryEmployeeHistory::create(['employee_id' => $employee->id, 'pay' => $employee->pay, 'bonus' => $employee->bonus]);
        }
    }

    /**
     * Handle the EmployeeSalary "deleted" event.
     *
     * @param  \App\Models\EmployeeSalary  $employeeSalary
     * @return void
     */
    public function deleted(EmployeeSalary $employeeSalary)
    {
        //
    }

    /**
     * Handle the EmployeeSalary "restored" event.
     *
     * @param  \App\Models\EmployeeSalary  $employeeSalary
     * @return void
     */
    public function restored(EmployeeSalary $employeeSalary)
    {
        //
    }

    /**
     * Handle the EmployeeSalary "force deleted" event.
     *
     * @param  \App\Models\EmployeeSalary  $employeeSalary
     * @return void
     */
    public function forceDeleted(EmployeeSalary $employeeSalary)
    {
        //
    }
}
