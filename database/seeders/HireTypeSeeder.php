<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\HireType;
use Faker;

class HireTypeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $type = ['odredjeno', 'neodredjeno', 'stalno', 'probni rad'];
        for($i = 0; $i<4; $i++){
            HireType::create([
                'type' => $type[$i],
            ]);
        }
    }
}
