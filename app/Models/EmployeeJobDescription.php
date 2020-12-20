<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Sector;

class EmployeeJobDescription extends Model
{
    use HasFactory;
    protected $table = 'employee_job_descriptions';

    public $primaryKey = "id";
    protected $guarded = [];

    public function employeeSalary()
    {
        return $this->hasOne(EmployeeSalary::class);
    }
    public function employee(){
        return $this->belongsTo(Employee::class);
    }

}
