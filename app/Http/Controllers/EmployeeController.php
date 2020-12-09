<?php

namespace App\Http\Controllers;

use App\Models\Employee;
use Illuminate\Http\Request;
use App\Http\Requests\EmployeeRequest;

class EmployeeController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $objects = Employee::get();

        /*return $employee;*/
        return view("employees",  compact("objects" ));
    }


    public function getOne($id){
        $object = Employee::find($id);
        return $object ? $object : null;
    }


    public function store(EmployeeRequest $request){
        $data = $request->validated();
        //$data["create_user_id"] = Auth::user()->id;
        Employee::create($data);
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
