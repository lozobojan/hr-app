<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class EmployeeJobStatus extends Model
{
    use HasFactory;

    protected $table = 'employee_job_statuses';

    public $primaryKey = "id";
    protected $guarded = [];
    public function employee(){
        return $this->belongsTo(Employee::class);
    }
}
