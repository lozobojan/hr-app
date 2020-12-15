<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Sector;

class EmployeeJobDescription extends Model
{
    use HasFactory;

    public function employeeSalary()
    {
        return $this->hasOne(EmployeeSalary::class);
    }

}
