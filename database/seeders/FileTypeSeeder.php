<?php

namespace Database\Seeders;

use App\Models\FileType;
use Illuminate\Database\Seeder;

class FileTypeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $types = ['Ugovor', 'Izvjestaj', 'CV', 'Faktura'];
        for($i = 0; $i < count($types); $i++){
            FileType::create([
                'name' => $types[$i]
            ]);
        }
    }
}
