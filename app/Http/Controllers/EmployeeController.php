<?php

namespace App\Http\Controllers;

use App\Models\Employee;
use App\Models\EmployeeSalary;
use Illuminate\Http\Request;
use App\Http\Requests\EmployeeRequest;
use App\Http\Requests\EmployeeSalaryRequest;

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
/*dd($objects);*/
        /*return $employee;*/
        return view("employees",  compact("objects" ));
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







    public function destroy($id){
        $object = Employee::find($id);

        // REORDER PARENTS FOR DELETE


        if($object)
            $object->delete();
        return back()->with("success", "Element uspješno obrisan!");
    }
}
