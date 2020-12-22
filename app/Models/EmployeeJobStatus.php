<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Carbon;

class EmployeeJobStatus extends Model
{
    use HasFactory;

    protected $table = 'employee_job_statuses';

    public $primaryKey = "id";
    protected $guarded = [];

    public function getDateHiredAttribute($value)
    {
        return Carbon::parse($value)->format("d.m.Y.");
    }

    public function setDateHiredAttribute($value)
    {
        $this->attributes["date_hired"] = Carbon::createFromFormat("d.m.Y.", $value);
    }

    public function getDateHiredTillAttribute($value)
    {
        return Carbon::parse($value)->format("d.m.Y.");
    }

    public function setDateHiredTillAttribute($value)
    {
        $this->attributes["date_hired_till"] = Carbon::createFromFormat("d.m.Y.", $value);
    }
    public function employee(){
        return $this->belongsTo(Employee::class);
    }

}
