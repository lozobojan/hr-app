<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Models\Documentation;
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
        $files = Documentation::where('is_folder', 0)->orderBy('id', 'ASC')->get();
        return response(compact('directories', 'files'));
    }
    
}
