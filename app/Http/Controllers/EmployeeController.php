<?php

namespace App\Http\Controllers;

use App\Models\Employee;
use App\Models\EmployeeSalary;
use Barryvdh\DomPDF\Facade as PDF;
use Illuminate\Http\Request;
use App\Http\Requests\EmployeeRequest;
use App\Http\Requests\EmployeeSalaryRequest;
use App\Exports\EmployeeExport;
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
        $object = Employee::with('employeeSalary')->find($id);
        return $object ? $object : null;
    }


    public function store(EmployeeRequest $request, EmployeeSalaryRequest $data2){
        $data = $request->validated();
        $salaryRequest = $data2->validated();
        $employee = Employee::create($data);
        $salaryRequest["employee_id"] = $employee->id;
        EmployeeSalary::create($salaryRequest);

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


    public function pdf($id)
    {
        $employee = Employee::with('EmployeeSalary')
            ->where('id', $id)

            ->first();
        $pdf = PDF::loadView('employees.pdf');
       // dd($pdf);
        return $pdf->download('employees.pdf');
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
