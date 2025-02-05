<?php

namespace Database\Seeders;

use App\Models\City;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class CitySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run($namecity,$provinceid): void
    {
        $cityarray = config('cities.'.$namecity);

        if(is_array($cityarray)){
        foreach ($cityarray as $dataciy) {
            $dataciy['province_id'] = $provinceid;
            City::create($dataciy);
         }
        }
    }
}
