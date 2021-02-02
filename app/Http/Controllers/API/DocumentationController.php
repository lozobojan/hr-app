<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Models\Documentation;
use App\Models\FileType;
use App\Models\Sector;
use Directory;
use Illuminate\Http\Request;

class DocumentationController extends Controller
{
    public function showDirectories()
    {
        $directories = Documentation::where([
            ['is_folder', 1],
            ['parent_id', null]
        ])->orderBy('id', 'ASC')->get();
        $files = Documentation::select('file_path', 'name')->where('is_folder', 0)->orderBy('id', 'ASC')->get();
        $types = FileType::all();
        $sectors = Sector::all();
        return response(compact('directories', 'files', 'types', 'sectors'));
    }
    
}
