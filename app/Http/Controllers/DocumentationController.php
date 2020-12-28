<?php

namespace App\Http\Controllers;

use App\Http\Requests\DocumentationRequest;
use App\Models\Documentation;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;

class DocumentationController extends Controller
{
    public function index()
    {
        $roots = Documentation::root()->get();

        return view('documentation', [
            'roots' => $roots
        ]);
    }

    public function getDir($id)
    {
        $roots = Documentation::where('parent_id', $id)->get();
        return view('documentation', ['roots' => $roots]);
    }

    public function download($id)
    {
        return response()->download(Documentation::find($id)->file_path);
        // Documentation::where('id', $id)->first();
        // return PDF::download()
        // return redirect()->back();
    }

    public function mkDir(DocumentationRequest $request)
    {
        $data = $request->validated();
        if($request->hasFile('file_path')){
            $data['file_path'] = $request->file('file_path')->store('documentation');
        }
        Documentation::create($data);
        return Redirect::back()->withErrors(['msg', 'Uspjesno dodato!']);
    }

    public function store($data)
    {
        // $data = $request->validated();
        // $data["create_user_id"] = Auth::user()->id;
        // $data['name'] = array('en' => $data['name_en'], 'me' => $data['name_me']);
        // $data['description'] = array('en' => str_replace("\r\n", "<br>", $data['description_en']), 'me' => str_replace("\r\n", "<br>", $data['description_me']));
        $data['file_path'] = $this->storeImage($data['image_path'], 'documentation');
        // unset($data['description_me'], $data['description_en'], $data['name_me'], $data['name_en']);

        // if (isset($data['position'])) {
            // $shiftedObjects = Publication::where('position', '>=', $data['position'])->get();
            // foreach ($shiftedObjects as $object) {
                // $object->position += 1;
                // $object->save();
            // }
        // } else {
            // $data['position'] = Publication::count() + 1;
        // }

        Documentation::create($data);
        index();
        // return response()->json(["success" => "success"], 200);
    
    }
}