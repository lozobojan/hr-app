<?php

namespace App\Http\Controllers;


use App\Http\Requests\EmployeeJobDescriptionRequest;
use App\Http\Requests\SaveEmployeeRequest;
use App\Models\Employee;
use App\Models\EmployeeJobDescription;
use App\Models\EmployeeJobStatus;
use App\Models\EmployeeSalary;
use App\Models\HireType;
use App\Models\Sector;
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
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $objects = Employee::with('employeeJobDescription')->get();
        $sectors = Sector::get();
        $types = HireType::get();
        $data = [
            "objects" => $objects,
            "sectors" => $sectors,
            "types" => $types,
        ];
        return view("employees.index")->with($data);
    }


    public function getOne($id){
        $object = Employee::with('employeeSalary')->with('employeeJobStatus')->with('employeeJobDescription')->with('parent')->find($id);

        return $object ? $object : null;
    }


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

    public function edit(SaveEmployeeRequest $request,EmployeeRequest $empReq,EmployeeJobStatusRequest  $empJobStatReq, EmployeeSalaryRequest $empSalReq, EmployeeJobDescriptionRequest  $empJobDesReq, Employee $object) {
       /* $data = $request->validated();
        $emp = [
            "name" => $data['name'],
            "last_name" => $data['last_name'],
            "birth_date" => $data['birth_date'],
            "jmbg" => $data['jmbg'],
            "email" => $data['email'],
            "image" => $data['image'],
            "qualifications" => $data['qualifications'],
            "home_address" => $data['home_address'],
            "additional_info" => $data['additional_info'],
            "telephone_number" => $data['telephone_number'],
            //"office_number" => $data['office_number'],
            "additional_info_contact" => $data['additional_info_contact'],
            "gender" => $data['gender'],
            "pid" => $data['pid'],
        ];

        $empSal = [
            "pay" => $data['pay'],
            "bonus" => $data['bonus'],
            "bank_name" => $data['bank_name'],
            "bank_number" => $data['bank_number'],
            "employee_id" => $object->id,

        ];
        $empJobDesc = [
            "workplace" => $data['workplace'],
            "job_description" => $data['job_description'],
            "skills" => $data['skills'],
            "sector_id" => $data['sector_id'],
            "employee_id" => $object->id,
        ];
        $empJobStatus = [
            "status" => $data['status'],
            "date_hired" => Carbon::createFromFormat("d.m.Y.",$data['date_hired']),
            "date_hired_till" => Carbon::createFromFormat("d.m.Y.",$data['date_hired_till']),
           // "date_hired_till" => $data['date_hired_till'],
            "additional_info" => $data['additional_info'],
            "type" => $data['type'],
            "employee_id" => $object->id,
        ];*/

        $empl = $empReq->validated();
        $empSala = $empSalReq->validated();
        $empJobDescr = $empJobDesReq->validated();
        $empJobStat = $empJobStatReq->validated();

        $empSala["employee_id"] = $object->id;
        $empJobStat["date_hired"] = Carbon::createFromFormat("d.m.Y.",$empJobStat['date_hired']);
        $empJobStat["date_hired_till"] = Carbon::createFromFormat("d.m.Y.",$empJobStat['date_hired_till']);
        $empJobStat["employee_id"] = $object->id;
        $empJobDescr["employee_id"] = $object->id;


        /*$object->fill($emp);*/
        $object->update($empl);
        $object->employeeSalary()->update($empSala);
        $object->employeeJobDescription()->update($empJobDescr);
        $object->employeeJobStatus()->update($empJobStat);
      /*  $object2->fill($empSal);
        $object2->update();*/


        return response()->json(['success' => 'success'], 200);
    }


    public function show($id)
    {
        $employee = Employee::with('parent')->with('employeeJobStatus')
            ->find($id);
        $objects = Employee::with('employeeJobDescription')->get();
        $sectors = Sector::get();
        $types = HireType::get();
        $data = [
            "objects" => $objects,
            "sectors" => $sectors,
            "employee" => $employee,
            "title" => "$employee->name $employee->last_name",
            "types" => $types
        ];
        return view('employees.show')->with($data);
    }


    public function filter(Request $request){
       // dd($request);
        $sector = $request->sector;
        $type = $request->type;
        $bank_name = $request->bank_name;
        $salary = $request->salary;


        $objects = Employee::with('employeeJobDescription');

        $objects = Employee::whereHas('employeeJobDescription', function($q) use ($sector, $request) {
            if($request->filled('sector')){
                $q->where('employee_job_descriptions.sector_id', $sector);
            }
        })->whereHas('employeeSalary', function($q) use ($salary, $request, $bank_name){
            if($request->filled('bank_name')){
                $q->where('employee_salaries.bank_name','LIKE',$bank_name);
            }
            if($request->filled('salary')){
                $q->where('employee_salaries.pay','>=',$salary);
            }
        })->whereHas('employeeJobStatus', function($q) use ($request, $type){
            if($request->filled('type')){
                $q->where('employee_job_statuses.type',$type);
            }
        })
            ->get();

        $sectors = Sector::get();
        $types = HireType::get();
        $data = [
            "objects" => $objects,
            "sectors" => $sectors,
            "types" => $types,
        ];
        return view("employees.index")->with($data);
    }



    public function createPDF($id) {
        // retreive all records from db
        $data = Employee::with('EmployeeSalary')
            ->where('id', $id)
            ->first();
        //// share data to view
        view()->share('employee',$data);
        $pdf = PDF::loadView('employees.pdf', $data);

        // download PDF file with download method
        return $pdf->download('pdf_file.pdf');
        //return view('employees.pdf', compact("employee"));
    }


    public function destroy($id){
        $object = Employee::find($id);

        // REORDER PARENTS FOR DELETE


        if($object)
            $object->delete();
        return back()->with("success", "Element uspješno obrisan!");
    }

    public function export($id)
    {
        $employee = new EmployeeExport($id);

        $name = $employee->fileName();
        return Excel::download($employee, "$name.xlsx");
        return redirect()->back();
    }

    public function doc($id) {
        // retreive all records from db
        $employee = Employee::with('EmployeeSalary')
            ->where('id', $id)
            ->first();
        $dt = Carbon::now()
            ->format('d.m.Y.');

        $stuff = [
          'data' => $employee,
            'today' => $dt
        ];

        //$filename = $data->name .' '. $data->last_name;


      //  $contents = View::make('employees.docs.sample')->with('data', $data);
        //$response = \Response::make($contents, 200);
        //$response->header('Content-Type', 'text/html')->header('Content-Disposition', "attachment;Filename=$filename.doc");
        return view('employees.docs.sample')->with($stuff);
        //// share data to view
        //return view('employees.docs.sample', compact('data'));

    }
}
