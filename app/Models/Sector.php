<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\EmployeeJobDescription;

class Sector extends Model
{
    use HasFactory;

    protected $table = 'sectors';

    public $primaryKey = "id";
    protected $guarded = [];

    /*public function employee(){
       return $this->hasMany(Employee::class);
  }*/

    public function employeeJobDescription(){
        return $this->hasMany(EmployeeJobDescription::class);
    }


}
