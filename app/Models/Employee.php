<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Carbon;

class Employee extends Model
{
    use HasFactory;
    protected $table = 'employees';

    public $primaryKey = "id";
    protected $guarded = [];

    public function getBirthDateAttribute($value)
    {
        return Carbon::parse($value)->format("d.m.Y.");
    }

    public function setBirthDateAttribute($value)
    {
        $this->attributes["birth_date"] = Carbon::createFromFormat("d.m.Y.", $value);
    }

    public function employeeSalary()
    {
        return $this->hasOne(EmployeeSalary::class);
    }
}
