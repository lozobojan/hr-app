<?php

namespace App\Http\Controllers;

use App\Models\Employee;
use App\Models\EmployeeSalary;
use Illuminate\Http\Request;
use DB;
use Acaronlex\LaravelCalendar\Calendar;

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
            ->whereRaw('datediff(date_hired_till, now()) < 60 AND datediff(date_hired_till, now()) >0')->get();

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
                     date('Y-m-d',strtotime("$datum  + 1 day")),
                    "user",
                    // Add color and link on event
                    [
                        'color' => '#f05050',
                        'url' => '/employees/'.$value->id,
                    ]
                );
            }
            }
        }


        $event2 = Employee::with('employeeJobStatus')->get();
        if($event2->count()) {

            foreach ($event2 as $key => $value) {
            $title = "UGOVOR \n $value->name $value->lst_name";
                $datum = \DateTime::createFromFormat('d.m.Y.', $value->employeeJobStatus->date_hired_till)->format('Y-m-d');

                    $events[] = Calendar::event(
                        $title,
                        true,
                        /*$this->updateDate(date('Y-m-d',strtotime("$value->birth_date  + $i year"))),*/
                        date('Y-m-d',strtotime("$datum")),
                        date('Y-m-d',strtotime("$datum")),
                        "user",

                        // Add color and link on event
                        [
                            'color' => '#32a852',
                            'description'=> 'yellow',
                            'url' => '/employees/'.$value->id,
                        ]
                    );
            }
        }


       $calendar = new Calendar();
        $calendar->addEvents($events)
            ->setOptions([
                'locale' => 'sr',
                'initialView' => 'dayGridMonth',
                'buttonText' => [
                  'today'=>    'Danas',
                  'month'=>    'mesec',
                  'week'=>     'nedelja',
                  'day'=>      'dan',
                  'list'=>     'list'
                    ],
                'headerToolbar' => [
                    'end' => 'today prev,next dayGridMonth timeGridWeek timeGridDay'
                ]
            ]);
        $calendar->setId('1');
        $calendar->setCallbacks([
            'eventMouseover' => 'function(event, jsEvent, view){console.log(event.title)}',
            'eventRender' => 'function (event,jqEvent,view) {jqEvent.tooltip({placement: "top", title: event.title});}',
        ]);
 /*       $calendar =new Calendar();
        $calendar->addEvents($events)->setOptions(['firstDay' => 1])->setCallbacks(['eventRender' => 'function (event,jqEvent,view) {jqEvent.tooltip({placement: "top", title: event.title});}']);*/


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
