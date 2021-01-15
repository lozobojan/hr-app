<?php

namespace App\Exports;

use App\Models\Employee;
use Maatwebsite\Excel\Concerns\FromQuery;
use Maatwebsite\Excel\Concerns\Exportable;
use Maatwebsite\Excel\Concerns\WithHeadings;

class EmployeeExport implements FromQuery, WithHeadings
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
    public function headings(): array
    {
        return [
            '#',
            'Ime',
            'Prezime',
        ];
    }

    public function query()
    {
        return Employee::query()->where('id', $this->id)->select('id', 'name', 'last_name');
    }
}
