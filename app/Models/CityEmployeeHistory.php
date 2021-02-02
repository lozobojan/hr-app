<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CityEmployeeHistory extends Model
{
    use HasFactory;
    protected $table = 'city_employee_history';

    public $primaryKey = "id";
    protected $guarded = [];
}
