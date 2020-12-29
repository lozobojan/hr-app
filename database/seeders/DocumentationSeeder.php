<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Documentation;

class DocumentationSeeder extends Seeder
{
    
    
    public function run(){
        
        $names = [
            'HR',
            'Marketing',
            'Finansije'
        ];
    
        $is_folder = [
            true,
            true,
            true
        ];

        $parent_id = [
            null,
            null,
            null
        ];

        $files = [
            null,
            null,
            null

        ];

        for($i = 0; $i < count($names); $i++){

            Documentation::create([
                'name' => $names[$i],
                'parent_id' => $parent_id[$i],
                'is_folder' => $is_folder[$i],
                'file_path' => $files[$i]
            ]);
        }

    }
}
