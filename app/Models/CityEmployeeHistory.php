<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Carbon;

class CityEmployeeHistory extends Model
{
    use HasFactory;
    public function getCreatedAtAttribute($value)
    {
        return Carbon::parse($value)->format("d.m.Y.");
    }


    protected $table = 'city_employee_history';

    public  function city(){
        return $this->hasOne(City::class, "id", "city_id");
    }


    public $primaryKey = "id";
    protected $guarded = [];
}
