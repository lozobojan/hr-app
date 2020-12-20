<?php

namespace App\Http\Controllers;


use App\Models\Employee;
use App\Models\EmployeeJobStatus;
use App\Models\EmployeeSalary;
use Illuminate\Http\Request;
use App\Http\Requests\EmployeeRequest;
use App\Http\Requests\EmployeeSalaryRequest;
use App\Http\Requests\EmployeeJobStatusRequest;
use App\Exports\EmployeeExport;
use DB;

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
        $objects = Employee::with('employeeSalary')->get();
        return view("employees.index",  compact("objects" ));
    }


    public function getOne($id){
        $object = Employee::with('employeeSalary')->with('employeeJobStatus')->find($id);
        return $object ? $object : null;
    }


    public function store(EmployeeRequest $request, EmployeeSalaryRequest $data2, EmployeeJobStatusRequest $data3){

        DB::beginTransaction();
        try {
            $data = $request->validated();
            $salaryRequest = $data2->validated();
            $jobStatusRequest = $data3->validated();
            $employee = Employee::create($data);
            $salaryRequest["employee_id"] = $employee->id;
            $jobStatusRequest["employee_id"] = $employee->id;
            EmployeeSalary::create($salaryRequest);
            EmployeeJobStatus::create($jobStatusRequest);

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
}
