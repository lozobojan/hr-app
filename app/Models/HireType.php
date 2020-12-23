<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class HireType extends Model
{
    use HasFactory;
    public function employeeJobStatus() {
        return $this->hasMany(EmployeeJobStatus::class, 'type');
    }
}
