<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Models\Documentation;
use App\Models\FileType;
use App\Models\Sector;
use Illuminate\Support\Facades\Cache;

class DocumentationController extends Controller
{
    public function showDirectories()
    {
        $directories = Cache::rememberForever('directories', function(){
            return Documentation::where([
                ['is_folder', 1],
                ['parent_id', null]
            ])->orderBy('id', 'ASC')->get();
        });

        $files = Cache::rememberForever('files', function(){
            return Documentation::select('file_path', 'name')->where('is_folder', 0)->orderBy('id', 'ASC')->get();
        });
        
        $types = Cache::rememberForever('types', function(){ 
            return FileType::all(); 
        });
        
        $sectors = Cache::rememberForever('sectors', function(){ 
            return Sector::all();
        });

        return response(compact('directories', 'files', 'types', 'sectors'));
    }
    
}
