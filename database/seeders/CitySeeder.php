<?php

declare(strict_types=1);

namespace Database\Seeders;

use App\Models\City;
use Illuminate\Database\Seeder;

final class CitySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run($namecity, $provinceid): void
    {
        $cityarray = config('cities.'.$namecity);

        if (is_array($cityarray)) {
            foreach ($cityarray as $dataciy) {
                $dataciy['province_id'] = $provinceid;
                City::create($dataciy);
            }
        }
    }
}
