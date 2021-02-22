<?php

namespace App\Models;

use App\Observers\EmployeeSalaryObserver;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Carbon;

class EmployeeSalary extends Model
{
    use HasFactory;

    protected $table = 'employee_salaries';

    public $primaryKey = "id";
    protected $guarded = [];

    public function employee(){
        return $this->belongsTo(Employee::class);
    }

    public function employeeHistory(){
        return $this->belongsToMany(Employee::class, "salary_employee_history");
    }


}
