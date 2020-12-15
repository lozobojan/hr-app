<?php

namespace App\Exports;

use App\Models\Employee;
use Maatwebsite\Excel\Concerns\FromQuery;
use Maatwebsite\Excel\Concerns\Exportable;

class EmployeeExport implements FromQuery
{

    use Exportable;



    public function __construct(int $id)
    {
        $this->id = $id;
    }
    public function fileName(){
       $employee = Employee::where('id', $this->id)->first();
       return "$employee->name $employee->last_name";
    }

    public function query()
    {
        return Employee::query()->where('id', $this->id);
    }
}
