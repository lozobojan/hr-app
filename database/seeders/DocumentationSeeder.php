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
            'Level 1',
            'Level 2',
            'Level 3',
            'Level 1',
            'Level 2',
            'Level 3',
            'Level 4',
            'Level 1',
            'Level 2',
            'Level 1',
        ];

        $parent_id = [
            null,
            null,
            null,
            1,
            4,
            5,
            2,
            7,
            8,
            9,
            1,
            11,
            1
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
