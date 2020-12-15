<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Sector;

class SectorSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $sectors = ['Delivery', 'Marketing', 'Human resources', 'Finansije'];
        for($i = 0; $i < 4; $i++){
            Sector::create([
                'name' => $sectors[$i]
            ]);
        }
    }
}
