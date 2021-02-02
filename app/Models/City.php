<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class City extends Model
{
    use HasFactory;

    protected $table = 'cities';

    public $primaryKey = "id";
    protected $guarded = [];

    public function employee(){
        return $this->hasMany(Employee::class);
    }
    public function employeeHistory(){
        return $this->hasMany(Employee::class);
    }
}
