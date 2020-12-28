<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Models\Documentation;
use Directory;
use Illuminate\Http\Request;

class DocumentationController extends Controller
{
    public function rootDirectories()
    {
        $directories = Documentation::where('parent_id', null)->where('is_folder', 1)->orderBy('id', 'DESC')->get();
        return response(compact('directories'));
    }
}
