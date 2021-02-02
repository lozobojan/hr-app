<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Models\Employee;
use App\Models\EmployeeJobDescription;
use App\Models\EmployeeJobStatus;
use Illuminate\Support\Facades\Cache;
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
        return Employee::orderBy("id", "DESC")->get();
        return response()->json(compact("employees"), 200);
    }

    public function employeesStatistics()
    {
        
        //Prosjecna plata
        $avgSalary = Cache::rememberForever('avgSalary', function(){
            return DB::table('employee_salaries')->selectRaw('ceiling(avg(pay)) as salary')->first();
        });

        //Prosjecan radni staz
        $avgService = Cache::rememberForever('avgService', function(){
            return DB::table('employee_job_statuses')
            ->selectRaw('DATE_FORMAT(FROM_DAYS(CEILING(avg(DATEDIFF(CURRENT_DATE, date_hired)))), "%y") AS date ')
            ->first();
        });

        //Zaposleni po sektorima

        // $employeesBySector = DB::select("SELECT COUNT(*) as count, name
        //                                 FROM(
        //                                     SELECT sector_id
        //                                     FROM(
        //                                         SELECT *
        //                                         FROM employee_job_statuses 
        //                                         WHERE CAST(now() AS date) < date_hired_till
        //                                         ) as o
        //                                     INNER JOIN employee_job_descriptions ON employee_job_descriptions.employee_id=o.employee_id
        //                                     ) as b
        //                                     INNER JOIN sectors ON sectors.id=b.sector_id
        //                                 GROUP BY sector_id");

        $employeesBySector = Cache::rememberForever('employeesBySector', function(){
            return DB::table(
                DB::raw(
                    "(" . DB::table(
                        DB::raw("(" .
                            EmployeeJobStatus::whereRaw('CAST(now() AS date) < date_hired_till')->toSql()
                            . ") o")
                    )->select("sector_id")
                        ->join("employee_job_descriptions", "o.employee_id", "=", "employee_job_descriptions.employee_id")
                        ->toSql() . ") o"
                )
            )->join("sectors", "o.sector_id", "=", "sectors.id")
                ->selectRaw("count(*) count, name")
                ->groupBy("sector_id")
                ->get();
        });

        //Prosjecna plata po sektorima
        $salaryBySector = Cache::rememberForever('salaryBySector', function(){
            return DB::table('employee_job_descriptions')
                ->join('sectors', 'employee_job_descriptions.sector_id', '=', 'sectors.id')
                ->join('employee_salaries', 'employee_job_descriptions.employee_id', '=', 'employee_salaries.employee_id')
                ->groupBy('id')
                ->selectRaw('sectors.name, sectors.id, AVG(employee_salaries.bonus + employee_salaries.pay) count')
                ->get();
        });

        //Ugovor na odredjeno
        $employeeCountOne = Cache::rememberForever('employeeCountOne', function(){
            return DB::table('employee_job_descriptions')
                ->join('sectors', 'employee_job_descriptions.sector_id', '=', 'sectors.id')
                ->join('employee_job_statuses', 'employee_job_descriptions.employee_id', '=', 'employee_job_statuses.employee_id')
                ->whereRaw('type = 1 AND CAST(now() AS date) < date_hired_till ')
                ->select('sector_id', 'name', DB::raw('count(*) as count'))
                ->groupBy('sector_id')
                ->get();
        });

        //Ugovor na neodredjeno
        $employeeCountTwo = Cache::rememberForever('employeeCountTwo', function(){
            return DB::table('employee_job_descriptions')
                ->join('sectors', 'employee_job_descriptions.sector_id', '=', 'sectors.id')
                ->join('employee_job_statuses', 'employee_job_descriptions.employee_id', '=', 'employee_job_statuses.employee_id')
                ->whereRaw('type = 2 AND CAST(now() AS date) < date_hired_till ')
                ->select('sector_id', 'name', DB::raw('count(*) as count'))
                ->groupBy('sector_id')
                ->get();
        });

        //Ugovor za stalno
        $employeeCountThree = Cache::rememberForever('employeeCountThree', function(){
            return DB::table('employee_job_descriptions')
                ->join('sectors', 'employee_job_descriptions.sector_id', '=', 'sectors.id')
                ->join('employee_job_statuses', 'employee_job_descriptions.employee_id', '=', 'employee_job_statuses.employee_id')
                ->whereRaw('type = 3 AND CAST(now() AS date) < date_hired_till ')
                ->select('sector_id', 'name', DB::raw('count(*) as count'))
                ->groupBy('sector_id')
                ->get();
        });

        //Ugovor za probni rad
        $employeeCountFour = Cache::rememberForever('employeeCountFour', function(){
            return DB::table('employee_job_descriptions')
                ->join('sectors', 'employee_job_descriptions.sector_id', '=', 'sectors.id')
                ->join('employee_job_statuses', 'employee_job_descriptions.employee_id', '=', 'employee_job_statuses.employee_id')
                ->whereRaw('type = 4 AND CAST(now() AS date) < date_hired_till ')
                ->select('sector_id', 'name', DB::raw('count(*) as count'))
                ->groupBy('sector_id')
                ->get();
        });

        //Starost zaposlenih
        $employeeAge = Cache::rememberForever('employeeAge', function(){
            return Employee::selectRaw("count(*) count, '-25' as name")
                ->whereRaw("date_format(FROM_DAYS(DATEDIFF(CAST(now() AS date), birth_date)),'%y') < 25")
                ->union(
                    Employee::selectRaw("count(*) count, '25-30' as name")
                        ->whereRaw("date_format(FROM_DAYS(DATEDIFF(CAST(now() AS date), birth_date)),'%y') BETWEEN 25 AND 30")
                )->union(
                    Employee::selectRaw("count(*) count, '31-35' as name")
                        ->whereRaw("date_format(FROM_DAYS(DATEDIFF(CAST(now() AS date), birth_date)),'%y') BETWEEN 31 AND 35")
                )->union(
                    Employee::selectRaw("count(*) count, '36-45' as name")
                        ->whereRaw("date_format(FROM_DAYS(DATEDIFF(CAST(now() AS date), birth_date)),'%y') BETWEEN 36 AND 45")
                )->union(
                    Employee::selectRaw("count(*) count, '45+' as name")
                        ->whereRaw("date_format(FROM_DAYS(DATEDIFF(CAST(now() AS date), birth_date)),'%y') > 45")
                )
                ->get();
        });

        //Broj zaposlenih po godinama

        // DB::statement( DB::raw( 'SET @SUM := 0'));
        // $employeeCountPerYear = DB::select('SELECT year as name, (@SUM := @SUM + count) as count
        //                                     FROM(
        //                                         SELECT year, sum(count) as count
        //                                         FROM(
        //                                             SELECT year(date_hired) year, count(*) count 
        //                                             FROM `employee_job_statuses` 
        //                                             GROUP BY year
        //                                             UNION
        //                                             SELECT year(date_hired_till) year, -count(*) count 
        //                                             FROM `employee_job_statuses` 
        //                                             GROUP BY year
        //                                             ) as o
        //                                         GROUP BY year
        //                                         ) as t1
        //                                 ');

        $employeeCountPerYear = Cache::rememberForever('employeeCountPerYear', function(){
            DB::statement(DB::raw('SET @SUM := 0'));
            return DB::table(DB::raw("(" . DB::table(
                DB::raw("(" .
                    EmployeeJobStatus::selectRaw('year(date_hired) year, count(*) count')->groupBy("year")
                    ->union(
                        EmployeeJobStatus::selectRaw('year(date_hired_till) year, -count(*) count')->groupBy("year")
                    )->toSql()
                    . ") o")
            )->selectRaw("year, sum(count) as count")->groupBy("year")->toSql() . ") t1"))->selectRaw("year as name, (@SUM := @SUM + count) as count")->get();
        });

        return response(compact('salaryBySector', 'employeesBySector', 'employeeCountOne', 'employeeCountTwo', 'employeeAge', 'avgSalary', 'avgService', 'employeeCountThree', 'employeeCountFour', 'employeeCountPerYear'));
    }
}
