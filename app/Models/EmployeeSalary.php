<?php

namespace App\Models;

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
}
