<?php

namespace App\Http\Controllers;

use App\Models\Employee;
use App\Models\EmployeeSalary;
use Illuminate\Http\Request;
use DB;
use Calendar;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        $objects = DB::table('employee_job_statuses')
            ->selectRaw('*, datediff(date_hired_till, now()) as days_till')
            ->join('employees', 'employees.id', '=', 'employee_job_statuses.employee_id')
            ->whereRaw('datediff(date_hired_till, now()) < 60')->get();

        $employeesCount = Employee::count();
        $avgSalary = EmployeeSalary::avg('pay');
        $avgAge = DB::table('employees')
            ->selectRaw("avg(DATE_FORMAT(FROM_DAYS(DATEDIFF(CURRENT_DATE, birth_date)),'%y')) AS age ")
        ->get();
        $gender = DB::table('employees')
            ->selectRaw(" COUNT(*) AS count")->groupBy('gender')
            ->get();



        //Calendar
        $events = [];
        $event = Employee::all();
        if($event->count()) {

            foreach ($event as $key => $value) {
                for($i = 0; $i<3; $i++){
                    $datum = $this->updateDate($value->birth_date)->format('d.m.Y.');
                    $datum = \DateTime::createFromFormat('d.m.Y.', $datum)->format('d.m.Y.');

                    $events[] = Calendar::event(
                    $value->name,
                    true,
                     /*$this->updateDate(date('Y-m-d',strtotime("$value->birth_date  + $i year"))),*/
                     date('Y-m-d',strtotime("$datum  + $i year")),
                     date('Y-m-d',strtotime("$datum  + $i year")),
                    null,
                    // Add color and link on event
                    [
                        'color' => '#f05050',
                        'url' => '/employees/'.$value->id,
                    ]
                );
            }
            }
        }
        $calendar = Calendar::addEvents($events);


        $data = [
            'employeesCount' => $employeesCount,
            'avgSalary' => round($avgSalary,1),
            'avgAge' => round($avgAge[0]->age,1),
            'gender' => ['male' => $gender[0]->count, 'female' => $gender[1]->count],
            'calendar' => $calendar
        ];


        return view('home')->with($data);
    }

    public function updateDate($dateString){
        $suppliedDate = new \DateTime($dateString);
        $currentYear = (int)(new \DateTime())->format('Y');
        return (new \DateTime())->setDate($currentYear, (int)$suppliedDate->format('m'), (int)$suppliedDate->format('d'));
    }
}
