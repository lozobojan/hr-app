<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Models\Employee;
use App\Models\EmployeeJobDescription;
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
        $employees = Employee::orderBy("id", "DESC")->get();
        return response()->json(compact("employees"), 200);
    }
    
    public function employeesBySector(){
        
        //Prosjecna plata
        $avgSalary = DB::table('employee_salaries')->selectRaw('ceiling(avg(pay)) as salary')->first();        

        //Prosjecan radni staz
        $avgService = DB::table('employee_job_statuses')
            ->selectRaw('DATE_FORMAT(FROM_DAYS(CEILING(avg(DATEDIFF(CURRENT_DATE, date_hired)))), "%y") AS date ')
            ->first();
        
        
        //Zaposleni po sektorima
        $employeesBySector = EmployeeJobDescription::join('sectors','employee_job_descriptions.sector_id','=','sectors.id')
            ->groupBy('sector_id')
            ->selectRaw('sector_id, name, count(*) count')
            ->get();

        //Prosjecna plata po sektorima
        $salaryBySector = DB::table('employee_job_descriptions')
            ->join('sectors','employee_job_descriptions.sector_id','=','sectors.id')
            ->join('employee_salaries','employee_job_descriptions.employee_id','=','employee_salaries.employee_id')
            ->groupBy('id')
            ->selectRaw('sectors.name, sectors.id, AVG(employee_salaries.bonus + employee_salaries.pay) count')
            ->get();
        
        //Ugovor na odredjeno
        $employeeCountOne = DB::table('employee_job_descriptions')
            ->join('sectors','employee_job_descriptions.sector_id','=','sectors.id')
            ->join('employee_job_statuses','employee_job_descriptions.employee_id','=','employee_job_statuses.employee_id')
            ->where('type', 1)
            ->select('sector_id', 'name', DB::raw('count(*) as count'))
            ->groupBy('sector_id')
            ->get();
        
        //Ugovor na neodredjeno
        $employeeCountTwo = DB::table('employee_job_descriptions')
            ->join('sectors','employee_job_descriptions.sector_id','=','sectors.id')
            ->join('employee_job_statuses','employee_job_descriptions.employee_id','=','employee_job_statuses.employee_id')
            ->where('type', 2   )
            ->select('sector_id', 'name', DB::raw('count(*) as count'))
            ->groupBy('sector_id')
            ->get();

        //Ugovor za stalno
        $employeeCountThree = DB::table('employee_job_descriptions')
            ->join('sectors','employee_job_descriptions.sector_id','=','sectors.id')
            ->join('employee_job_statuses','employee_job_descriptions.employee_id','=','employee_job_statuses.employee_id')
            ->where('type', 3)
            ->select('sector_id', 'name', DB::raw('count(*) as count'))
            ->groupBy('sector_id')
            ->get();

        //Ugovor za probni rad
        $employeeCountFour = DB::table('employee_job_descriptions')
            ->join('sectors','employee_job_descriptions.sector_id','=','sectors.id')
            ->join('employee_job_statuses','employee_job_descriptions.employee_id','=','employee_job_statuses.employee_id')
            ->where('type', 4)
            ->select('sector_id', 'name', DB::raw('count(*) as count'))
            ->groupBy('sector_id')
            ->get();
        
        //Starost zaposlenih
        $employeeBirthYears = Employee::select(DB::raw('YEAR(birth_date) year'))->get();
        $employeeAge = Employee::select('birth_date')->get();
        for($i = 0; $i < count($employeeAge); $i++){
            $employeeAge[$i] = $employeeAge[$i]->getAgeAttribute();
        }

        //Broj zaposlenih po godinama
        $employeeCountPerYear = DB::select('SELECT year, sum(count) as count
                                            FROM(
                                                SELECT year(date_hired) year, count(*) count FROM `employee_job_statuses` GROUP BY year
                                                UNION
                                                SELECT year(date_hired_till) year, -count(*) count FROM `employee_job_statuses` GROUP BY year
                                            ) as test
                                            WHERE year <= year(now())
                                            GROUP BY year
                                        ');

        return response(compact('salaryBySector', 'employeesBySector', 'employeeCountOne','employeeCountTwo', 'employeeBirthYears', 'employeeAge' , 'avgSalary', 'avgService', 'employeeCountThree', 'employeeCountFour', 'employeeCountPerYear'));
    }
}
