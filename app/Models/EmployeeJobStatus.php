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

    public function employee(){
        return $this->belongsTo(Employee::class);
    }
    public function hireType(){
        return $this->belongsTo(HireType::class, 'type');
    }

   public function getDateHiredAttribute($value)
    {
        return Carbon::parse($value)->format("d.m.Y.");
    }


  public function getDateHiredTillAttribute($value)
    {
        return Carbon::parse($value)->format("d.m.Y.");
    }

}
