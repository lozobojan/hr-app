<?php

namespace App\Models;

use App\Http\Requests\EmployeeSalaryRequest;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Carbon;
use App\Traits\FileHandling;

class Employee extends Model
{
    use HasFactory,FileHandling;
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
    public function setImageAttribute($value)
    {
        if($value)
            $this->attributes["image"] = is_string($value) ? $value : Employee::storeFile($value, "employees");
    }


//-------------------------------------------- Relationships ---------------------------------------------------
    public function employeeSalary()
    {
        return $this->hasOne(EmployeeSalary::class);
    }
    public function employeeJobDescription()
    {
        return $this->hasOne(EmployeeJobDescription::class);
    }
    public function employeeJobStatus()
    {
        return $this->hasOne(EmployeeJobStatus::class);
    }
   /*public function sector()
    {
        return $this->belongsTo(Sector::class);
    }*/


//-------------------------------------------- Relationships ---------------------------------------------------

    public static function boot() {
        parent::boot();

        static::deleting(function($employee) { // before delete() method call this
            $employee->employeeSalary()->delete();
            // do the rest of the cleanup...
        });
    }
}
