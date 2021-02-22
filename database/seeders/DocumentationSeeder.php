<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Documentation;

class DocumentationSeeder extends Seeder
{
    
    
    public function run(){
        
        $names = [
            'Zaposleni',
            'HR',
            'Marketing',
            'Finansije',

        ];

        $parent_id = [
            null,
            null,
            null,
            null,
        ];

        for($i = 0; $i < count($names); $i++){

            Documentation::create([
                'name' => $names[$i],
                'parent_id' => $parent_id[$i],
                'is_folder' => true,
                'file_path' => null
            ]);
        }

    }
}
