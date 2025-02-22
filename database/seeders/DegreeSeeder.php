<?php

namespace Database\Seeders;

use App\Models\Degree;
use Illuminate\Database\Seeder;

class DegreeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $degree = [
            [
                'degree_name' => 'Doctor',
                'degree_code' => 'Dr',
            ],
            [
                'degree_name' => 'Doctora',
                'degree_code' => 'Dra',
            ],
            [
                'degree_name' => 'Licenciado',
                'degree_code' => 'Lic',
            ],
            [
                'degree_name' => 'Licenciada',
                'degree_code' => 'Lcda',
            ],

        ];

        foreach ($degree as $degree) {
            Degree::create($degree);
        }
    }
}
