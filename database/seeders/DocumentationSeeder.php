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
            'Finansije',
            'Testni PDF',
            'Projektni zadatak'
        ];
    
        $is_folder = [
            true,
            true,
            true,
            false,
            false,
        ];

        $parent_id = [
            null,
            null,
            null,
            null,
            null,
        ];

        $files = [
            null,
            null,
            null,
            'storage/files/lorem-ipsum.pdf',
            'storage/files/HR Projektni.docx',

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
