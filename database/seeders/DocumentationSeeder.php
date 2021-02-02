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
            'Level 1',
            'Level 2',
            'Level 3',
            'Level 1',
            'Level 2',
            'Level 3',
            'Level 4',
            'Level 1',
            'Level 2'
        ];

        $parent_id = [
            null,
            null,
            null,
            null,
            2,
            5,
            6,
            3,
            8,
            9,
            10,
            4,
            12
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
