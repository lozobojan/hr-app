<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Models\Employee;
use App\Models\EmployeeJobDescription;
use App\Models\Sector;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class EmployeeController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $employees = Employee::select('id', 'name', 'last_name', 'image', 'pid', 'email')->orderBy("id", "DESC")->get();
        return response()->json(compact("employees"), 200);
    }

    public function employeesBySector(){
        $sectorSalaries = DB::table('sectors')->select('id', 'name')->get();
        $bySector = DB::table('employee_job_descriptions')
        ->join('sectors','employee_job_descriptions.sector_id','=','sectors.id')
        ->join('employee_salaries','employee_job_descriptions.employee_id','=','employee_salaries.employee_id')
        ->join('employees','employee_job_descriptions.employee_id','=','employees.id')
        ->select('sectors.name', 'sectors.id', DB::raw('employee_salaries.bonus + employee_salaries.pay as total'), 'employees.birth_date')
        ->get();

        $EmployeeCount = DB::table('employee_job_descriptions')
        ->join('employee_job_statuses','employee_job_descriptions.employee_id','=','employee_job_statuses.employee_id')
        ->where('type', 1)
        ->select('sector_id', DB::raw('count(*) as count'))
        ->groupBy('sector_id')
        ->get();

        $employeeBirthYears = Employee::select(DB::raw('YEAR(birth_date) year'), DB::raw('count(*) as count'))
        ->groupby('year')
        ->get();

        $employeeBirthDates = Employee::select('birth_date')
        ->get();

        for($i = 0; $i < 4; $i++){
            for($j = 0 ; $j < count($bySector); $j++){
                if($sectorSalaries[$i]->id == $bySector[$j]->id){
                    if(isset($sectorSalaries[$i]->salarySum)){
                        $sectorSalaries[$i]->salarySum += $bySector[$j]->total;
                    }
                    else{
                        $sectorSalaries[$i]->salarySum = $bySector[$j]->total;
                    }
                }
            }
        }

        $employeesBySector = EmployeeJobDescription::select('sector_id', DB::raw('count(*) as count'))
            ->groupBy('sector_id')
            ->get();
        return response(compact('bySector', 'sectorSalaries', 'employeesBySector', 'EmployeeCount', 'employeeBirthYears', 'employeeBirthDates'));
    }
}
