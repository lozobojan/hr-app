<?php

namespace App\Http\Controllers;


use App\Http\Requests\EmployeeJobDescriptionRequest;
use App\Models\Employee;
use App\Models\EmployeeJobDescription;
use App\Models\EmployeeJobStatus;
use App\Models\EmployeeSalary;
use App\Models\Sector;
use Illuminate\Http\Request;
use App\Http\Requests\EmployeeRequest;
use App\Http\Requests\EmployeeSalaryRequest;
use App\Http\Requests\EmployeeJobStatusRequest;
use App\Exports\EmployeeExport;
use DB;
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
        $data = [
            "objects" => $objects,
            "sectors" => $sectors,
        ];
        return view("employees.index")->with($data);
    }


    public function getOne($id){
        $object = Employee::with('employeeSalary')->with('employeeJobStatus')->with('employeeJobDescription')->find($id);
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
            $salaryRequest["employee_id"] = $employee->id;
            $jobStatusRequest["employee_id"] = $employee->id;
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

    public function edit(EmployeeRequest $request, Employee $object) {
        $data = $request->validated();
        $object->fill($data);
        $object->save();
        return response()->json(['success' => 'success'], 200);
    }


    public function show($id)
    {
        $employee = Employee::with('EmployeeSalary')
            ->where('id', $id)
            ->select('id', 'name', 'last_name', 'jmbg', 'birth_date', 'email', 'mobile_number', 'telephone_number','qualifications','home_address' )
            ->first();
        return view('employees.show', compact("employee"));
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
        $data = Employee::with('EmployeeSalary')
            ->where('id', $id)
            ->first();
       /* $headers = array(

            "Content-type"=>"text/html",

            "Content-Disposition"=>"attachment;Filename=myGeneratefile.doc"

        );
        $content = view()->share('employees.docs.sample',$data);
        return \Response::make($content,200, $headers);*/


        $contents = View::make('employees.docs.sample')->with('data', $data);
        $response = \Response::make($contents, 200);
        $response->header('Content-Type', 'text/html')->header('Content-Disposition', 'attachment;Filename=myGeneratefile.doc');
        return $response;
        //// share data to view
        //return view('employees.docs.sample', compact('data'));

    }
}
