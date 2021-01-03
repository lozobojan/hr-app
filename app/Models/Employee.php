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

    public function getAgeAttribute()
    {
        return Carbon::parse($this->attributes['birth_date'])->age;
    }

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

    public function currentSalary(){
       return $this->employeeSalary()->orderBy('created_at', 'DESC')->first();
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
    public function parent() {
        return $this->belongsTo(static::class, 'pid');
    }
    public function children() {
        return $this->hasMany(static::class, 'pid');
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
            $employee->employeeJobStatus()->delete();
            $employee->employeeJobDescription()->delete();
            // do the rest of the cleanup...
        });
    }
}
