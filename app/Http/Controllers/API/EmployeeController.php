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
        $employees = Employee::orderBy("id", "DESC")->get();
        return response()->json(compact("employees"), 200);
    }

    public function employeesStatistics()
    {

        //Prosjecna plata
        $avgSalary = Cache::rememberForever('avgSalary', function () {
            return DB::table('employee_salaries')->selectRaw('ceiling(avg(pay)) as salary')->first();
        });

        //Prosjecan radni staz
        $avgService = Cache::rememberForever('avgService', function () {
            return DB::table('employee_job_statuses')
                ->selectRaw('DATE_FORMAT(FROM_DAYS(CEILING(avg(DATEDIFF(CURRENT_DATE, date_hired)))), "%y") AS date ')
                ->first();
        });

        //Broj zaposlenih i prosjecna plata po sektorima
        $bySector = Cache::rememberForever('employeesBySector', function () {
            return DB::table('employee_job_descriptions')
                ->join('employee_job_statuses', 'employee_job_statuses.employee_id', '=', 'employee_job_descriptions.employee_id')
                ->join('sectors', 'sectors.id', '=', 'employee_job_descriptions.sector_id')
                ->join('employee_salaries', 'employee_job_descriptions.employee_id', '=', 'employee_salaries.employee_id')
                ->selectRaw('count(*) count, sectors.name, ceiling(AVG(employee_salaries.pay)) pay')
                ->groupBy('sector_id')
                ->whereRaw('CAST(now() AS date) < date_hired_till')
                ->get();
        });

        //Zaposleni po tipu ugovora
        $byHireType = Cache::rememberForever('employeeByHireType', function () {
            return DB::table('employee_job_descriptions')
                ->join('sectors', 'employee_job_descriptions.sector_id', '=', 'sectors.id')
                ->join('employee_job_statuses', 'employee_job_descriptions.employee_id', '=', 'employee_job_statuses.employee_id')
                ->whereRaw('CAST(now() AS date) < date_hired_till ')
                ->select('sector_id', 'name', DB::raw('count(*) as count'), 'type')
                ->groupBy('type')
                ->groupBy('sector_id')
                ->get();
        });

        //Starost zaposlenih
        $employeeAge = Cache::rememberForever('employeeAge', function () {
            return DB::table('employees')
                ->join('employee_job_statuses', 'employees.id', '=', 'employee_job_statuses.employee_id')
                ->selectRaw("date_format(FROM_DAYS(DATEDIFF(CAST(now() AS date), birth_date)),'%y') as age")
                ->whereRaw('CAST(now() AS date) < date_hired_till')
                ->get();
        });

        //Broj zaposlenih po godinama
        $employeeCountPerYear = Cache::rememberForever('employeeCountPerYear', function () {
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

        return response(compact('bySector', 'employeeAge', 'avgSalary', 'avgService', 'employeeCountPerYear', 'byHireType'));
    }
}
