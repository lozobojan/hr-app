<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;

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

        return view('home', compact('objects'));
    }
}
