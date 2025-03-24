<?php

declare(strict_types=1);

namespace Database\Seeders;

use App\Models\Gender;
use Illuminate\Database\Seeder;

final class GenderSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $gender = [
            ['gender_name' => 'Masculino'],
            ['gender_name' => 'Femenino'],
        ];
        foreach ($gender as $datagender) {
            Gender::create($datagender);
        }
    }
}
