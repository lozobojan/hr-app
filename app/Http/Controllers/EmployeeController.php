<?php

namespace App\Http\Controllers;


use App\Exports\EmployeeExportAll;
use App\Http\Requests\EmployeeJobDescriptionRequest;
use App\Http\Requests\SaveEmployeeRequest;
use App\Models\Employee;
use App\Models\EmployeeJobDescription;
use App\Models\EmployeeJobStatus;
use App\Models\EmployeeSalary;
use App\Models\HireType;
use App\Models\Sector;
use App\Models\City;
use Illuminate\Http\Request;
use App\Http\Requests\EmployeeRequest;
use App\Http\Requests\EmployeeSalaryRequest;
use App\Http\Requests\EmployeeJobStatusRequest;
use App\Exports\EmployeeExport;
use App\Models\Documentation;
use DB;
use Illuminate\Support\Carbon;
use View;

use Maatwebsite\Excel\Facades\Excel;

class EmployeeController extends Controller
{
 //Index, Returns all data needed for the table
    public function index()
    {
        $objects = Employee::with('employeeJobDescription')->get();
        $sectors = Sector::get();
        $types = HireType::get();
        $city = City::get();
        $data = [
            "objects" => $objects,
            "sectors" => $sectors,
            "types" => $types,
            "cities" => $city,
        ];
        return view("employees.index")->with($data);
    }

//getOne returns data as a json for filling in the modal automatically
    public function getOne($id){
        $object = Employee::with('employeeSalary')
            ->with('employeeJobStatus')
            ->with('employeeJobDescription')
            ->with('parent')
            ->find($id);

        return $object ? $object : null;
    }

//Store, creates a new employee entry and folders for those entries
    public function store(EmployeeRequest $request, EmployeeSalaryRequest $request2, EmployeeJobStatusRequest $request3, EmployeeJobDescriptionRequest  $request4){

        DB::beginTransaction();
        try {
            $data = $request->validated();
            $salaryRequest = $request2->validated();
            $jobStatusRequest = $request3->validated();
            $jobDescriptionRequest = $request4->validated();
            $employee = Employee::create($data);
            Documentation::create([
                "name" => $employee->name." ".$employee->last_name,
                "parent_id" => 1,
                "sector_id" => $jobDescriptionRequest["sector_id"],
                "is_folder" => 1
            ]);
            $salaryRequest["employee_id"] = $employee->id;
            $jobStatusRequest["employee_id"] = $employee->id;
            $jobStatusRequest["date_hired"] = Carbon::createFromFormat("d.m.Y.",$jobStatusRequest['date_hired']);
            $jobStatusRequest["date_hired_till"] = Carbon::createFromFormat("d.m.Y.",$jobStatusRequest['date_hired_till']);

            $jobDescriptionRequest["employee_id"] = $employee->id;
            EmployeeSalary::create($salaryRequest);
            EmployeeJobStatus::create($jobStatusRequest);
            EmployeeJobDescription::create($jobDescriptionRequest);

            DB::commit();
        }catch (\Exception $ex){
            DB::rollBack();
            throw $ex;
        }
        return response()->json(["success" => "success"], 200);
    }

    //edit method that updates an employee entry and all it's relations
    public function edit(SaveEmployeeRequest $request,EmployeeRequest $empReq,EmployeeJobStatusRequest  $empJobStatReq, EmployeeSalaryRequest $empSalReq, EmployeeJobDescriptionRequest  $empJobDesReq, Employee $object) {

        $empl = $empReq->validated();
        $empSala = $empSalReq->validated();
        $empJobDescr = $empJobDesReq->validated();
        $empJobStat = $empJobStatReq->validated();

        $empSala["employee_id"] = $object->id;
        $empJobStat["date_hired"] = Carbon::createFromFormat("d.m.Y.",$empJobStat['date_hired']);
        $empJobStat["date_hired_till"] = Carbon::createFromFormat("d.m.Y.",$empJobStat['date_hired_till']);
        $empJobStat["employee_id"] = $object->id;
        $empJobDescr["employee_id"] = $object->id;

        $object->update($empl);
        $object->employeeSalary()->update($empSala);
        $object->employeeJobDescription()->update($empJobDescr);
        $object->employeeJobStatus()->update($empJobStat);

        return response()->json(['success' => 'success'], 200);
    }

    //show method that returns all data needed for the singular employee display
    public function show($id)
    {
        $employee = Employee::with('parent')->with('employeeJobStatus')
            ->find($id);
        $objects = Employee::with('employeeJobDescription')->get();
        $sectors = Sector::get();
        $types = HireType::get();
        $city = City::get();
        $data = [
            "objects" => $objects,
            "sectors" => $sectors,
            "employee" => $employee,
            "title" => "$employee->name $employee->last_name",
            "types" => $types,
            "cities" => $city
        ];
        return view('employees.show')->with($data);
    }

//filter method hat filters data from the table
    public function filter(Request $request){
        $sector = $request->sector;
        $type = $request->type;
        $bank_name = $request->bank_name;
        $salary_less = $request->salary_less;
        $salary_greater = $request->salary_greater;
        $city = $request->city;


        $objects = Employee::whereHas('employeeJobDescription', function($q) use ($sector, $request) {
            if($request->filled('sector')){
                $q->where('employee_job_descriptions.sector_id', $sector);
            }
        })->whereHas('employeeSalary', function($q) use ($salary_greater, $salary_less, $request, $bank_name){
            if($request->filled('bank_name')){
                $q->where('employee_salaries.bank_name','LIKE',$bank_name);
            }
            if($request->filled('salary_less')){
                $q->where('employee_salaries.pay','<=',$salary_less);
            }
            if($request->filled('salary_greater')){
                $q->where('employee_salaries.pay','>=',$salary_greater);
            }
        })->whereHas('employeeJobStatus', function($q) use ($request, $type){
            if($request->filled('type')){
                $q->where('employee_job_statuses.type',$type);
            }
        })->whereHas('city', function($q) use ($request, $city){
            if($request->filled('city')){
                $q->where('city_id',$city);
            }
        })->get();

        $sectors = Sector::get();
        $types = HireType::get();
        $cities = City::get();
        $data = [
            "objects" => $objects,
            "sectors" => $sectors,
            "types" => $types,
            "cities" => $cities,
        ];
        return view("employees.index")->with($data);
    }


//destroy, deletes an employee entry
    public function destroy($id){
        $object = Employee::find($id);

        if($object)
            $object->delete();
        return back()->with("success", "Element uspješno obrisan!");
    }
//export and export_all used for exporting data into excel file
    public function export($id)
    {
        $employee = new EmployeeExport($id);
        $name = $employee->fileName();
        return Excel::download($employee, "$name.xlsx");
    }

    public function export_all()
    {
        $employees = new EmployeeExportAll();
        return Excel::download($employees, "zaposleni.xlsx");
    }



//doc creates an contract out of the user data
    public function doc($id) {
        $employee = Employee::with('EmployeeSalary')
            ->where('id', $id)
            ->first();
        $dt = Carbon::now()
            ->format('d.m.Y.');

        $stuff = [
          'data' => $employee,
            'today' => $dt
        ];
        return view('employees.docs.sample')->with($stuff);
    }
}
