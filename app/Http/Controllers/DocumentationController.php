<?php

namespace App\Http\Controllers;

use App\Http\Requests\DocumentationRequest;
use App\Models\Documentation;
use App\Models\FileType;
use App\Models\Sector;
use App\Traits\FileHandling;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;

class DocumentationController extends Controller
{

    use FileHandling;

    public function index()
    {
        $roots = Documentation::root()->get();
        $types = FileType::all();
        $sectors = Sector::all();
        return view('documentation.documentation', compact('roots', 'types', 'sectors'));
    }
    
    public function showByDirectory($id)
    {
        $roots = Documentation::where('parent_id', $id)->get();
        $types = FileType::all();
        $sectors = Sector::all();
        return view('documentation.documentation', compact ('roots', 'id', 'types', 'sectors'));
    }
    
    public function showBySector($id)
    {
        $roots = Documentation::where('sector_id', $id)->get();
        $types = FileType::all();
        $sectors = Sector::all();
        return view('documentation.documentation', compact('roots', 'types', 'sectors'));
    }
    
    public function showByType($id)
    {
        $roots = Documentation::where('type_id', $id)->get();
        $types = FileType::all();
        $sectors = Sector::all();
        return view('documentation.documentation', compact('roots', 'types', 'sectors'));
    }

    public function search($word){
        $roots = Documentation::where('name', 'like', '%'.$word.'%')->get();
        $types = FileType::all();
        $sectors = Sector::all();
        return view('documentation.documentation', compact('roots', 'types', 'sectors'));
    }
    
    public function download($id)
    {
        return response()->download(Documentation::find($id)->file_path);
    }
    
    public function store(DocumentationRequest $request)
    {
        $data = $request->validated();
        Documentation::create($data);
        return Redirect::back()->withErrors(['msg', 'Uspjesno dodato!']);
    }

    public function edit(DocumentationRequest $request, Documentation $object)
    {
        $data = $request->validated();
        $object->fill($data);
        $object->save();
        return Redirect::back()->withErrors(['msg', 'Uspjesno promijenjeno!']);
    }

    public function getOne($id)
    {
        $object = Documentation::find($id);
        return $object ? $object : null;
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