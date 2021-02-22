<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Carbon;

class SalaryEmployeeHistory extends Model
{
    use HasFactory;
    public function getCreatedAtAttribute($value)
    {
        return Carbon::parse($value)->format("d.m.Y.");
    }


    protected $table = 'salary_employee_history';



    public $primaryKey = "id";
    protected $guarded = [];
}
