<?php

namespace App\Http\Controllers;

use App\Http\Requests\DocumentationRequest;
use App\Models\Documentation;
use App\Traits\FileHandling;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;

class DocumentationController extends Controller
{

    use FileHandling;

    public function index()
    {
        $roots = Documentation::root()->get();

        return view('documentation', [
            'roots' => $roots
        ]);
    }

    public function showByDirectory($id)
    {
        $roots = Documentation::where('parent_id', $id)->get();
        return view('documentation', compact ('roots', 'id'));
    }

    public function download($id)
    {
        return response()->download(Documentation::find($id)->file_path);
    }

    public function store(DocumentationRequest $request)
    {
        $data = $request->validated();
        if($data['is_folder'] == 0){
            if($request->hasFile('file_path')){
                $data['file_path'] = $this->storeDocument($request->file('file_path'));
            }
            else{
                return response()->json(["errors" => ["file_path" => ["Morate unijeti fajl!"]]], 422);
            }
        }
        if($data['parent_id'] == 0){
            unset($data['parent_id']);
        }
        Documentation::create($data);
        return Redirect::back()->withErrors(['msg', 'Uspjesno dodato!']);
    }

    public function delete($id){
        Documentation::where('id', $id)->delete();
        return Redirect::back()->withErrors(['msg', 'Uspjesno brisanje!']);
    }

    public function deleteAll($id){
        $doc = Documentation::where('id', $id)->first();
        $descendents = $doc->descendents();
        for($i = count($descendents) - 1; $i >= 0; $i--){
            $descendents[$i]->delete();
        }
        $doc->delete();
        return Redirect::back()->withErrors(['msg', 'Uspjesno brisanje!']);
    }

    public function deleteDirectory($id){
        $doc = Documentation::where('id', $id)->first();
        Documentation::where('parent_id', $id)->update(['parent_id' => $doc->parent_id]);
        $doc->delete();
        return Redirect::back()->withErrors(['msg', 'Uspjesno brisanje!']);
    }
}