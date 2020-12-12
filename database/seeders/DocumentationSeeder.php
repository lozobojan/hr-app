<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Documentation;

class DocumentationSeeder extends Seeder
{
    public $names = [
        'folder1',
        'folder2',
        'folder3',
        'folder4',
        'folder5',
        'folder6',
        'folder7',
        'folder8',
        'folder9',
        'folder10',
        'folder11',
    ];

    public $parent_id = [
        null,
        1,
        2,
        3,
        1,
        null,
        6,
        6,
        2,
        null,
        null,
    ];


    public function run(){

        for($i = 0; $i < count($this->names); $i++){

            if($i === 4)
                Documentation::create([
                    'name' => $this->names[$i],
                    'parent_id' => $this->parent_id[$i],
                    'is_folder' => false
                ]);
            else
                Documentation::create([
                    'name' => $this->names[$i],
                    'parent_id' => $this->parent_id[$i],
                ]);
        }

    }
}
